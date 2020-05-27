<?php

namespace App\Http\Controllers;

use App\Armaments;
use App\Comments;
use App\CraftTypes;
use App\Http\Controllers\Controller;
use App\SpaceCraft;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpaceCraftController extends Controller
{
    /**
     * Finds value input with based by what model is called
     * @param  bigInteger $id
     * @return use Symfony\Component\HttpFoundation\Response;
     */
    public function show($id) : Response
    {
    	$data = ['id' => $id];

    	$validator = \validator::make($data, [
    		'id' => 'required|integer'
    	]);
        
        if ($validator->fails()) {
        	return response()->json(['Can only input number'], 422 );
        }

		$craft = SpaceCraft::find($id);
		
		$craft->class = $craft->craftTypes()->first()->name;


		if (count($craft->armaments()->get()) > 0) {
            $armaments = $craft->armaments()->get();
            
            foreach ($armaments as $arma) {
                $arma->qty = $arma->pivot->qty;
            }

            $craft->armaments = $armaments;
		} 

        if (!$craft) {
            return response()->json(['Could not find any post'], 404);
        }

        return response()->json($craft, 200);
    }

    /**
     * Store request data for spaceships
     * @param  Request $request
     * @param  POST  $id
     * @return Response  Symfony\Component\HttpFoundation\Response;
    */
    public function store(Request $request) : Response
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'image' => 'required',
                'crew' => 'required',
                'value' => 'required',
                'status' => 'required',
                'craftname' => 'required | exists:App\CraftTypes,name',
                'armaments.*.title' => 'required | exists:App\Armaments,title',
                'armaments.*.qty' => 'required | numeric',                              
            ]
        );

        $craftID = CraftTypes::where('name', '=', $request->craftname)->first()->id;

        $spacecraft = SpaceCraft::create([
            'name' => $request->name,
            'image' => $request->image,
            'crew' => $request->crew,
            'value' => $request->value,
            'status' => $request->status,
            'crafttypes_id' => $craftID,     
        ]);

        $weapons = [];
        foreach ($request->armaments as $armament) {
        	$weapons[] = new Armaments($armament);
        }

        $spacecraft->armaments()->saveMany($weapons);

        return response()->json(['Successfully added SpaceCraft: '  .  $request->id, 201]);
    }

    /**
     * Updatess for space ships
     * @param  Request $request
     * @param  Post  $id
     * @param  Comment  $commentID
     * @return Response Symfony\Component\HttpFoundation\Response;
     */
    public function update(Request $request, $id) : Response
    {
        $craft = SpaceCraft::find($id);

        if (!$craft) {
            return response()->json(['data' => 'Could not find spaceships'], 404);
        }

        $data = [
            'name' => 'required',
            'image' => 'required',
            'crew' => 'required',
            'value' => 'required',
            'status' => 'required',
        ];

        if ($request->armaments) {
        	$data['armaments.*.title'] = 'required | exists:App\Armaments,title';
        	$data['armaments.*.qty'] = 'required | numeric';
        }

        if ($request->craftname) {
        	$data['craftname'] = 'required | exists:App\CraftTypes,name';
        }

        $this->validate($request, $data);

        $craft->name = $request->get('name');
        $craft->image = $request->get('image');
        $craft->crew = $request->get('crew');
        $craft->value = $request->get('value');
        $craft->status = $request->get('status');

        if ($request->craftname) {
        	$craftID = CraftTypes::where('name', '=', $request->craftname)->first()->id;
        	$craft->crafttypes_id = $craftID;	
        }

        $craft->save();

     	if ($request->armaments) {
     		$weapons = [];
	        foreach ($request->armaments as $armament) {
                $spacecraft = $craft->armaments()->where('title',$armament['title'])->first();
	        	
                if ($spacecraft && $spacecraft->qty === $armament['qty']) {
	        		continue;
	        	}

                if ($spacecraft && $spacecraft->qty != $armament['qty']) {
                    $craft->armaments()->updateExistingPivot($spacecraft->id, ['qty' => $armament['qty']]);
                    continue;
                }
                
	        	$weapons[] = new Armaments($armament);
	        }

	        $craft->armaments()->saveMany($weapons);
     	}
        
        return response()->json(['data' => 'Successfully Updated SpaceShips Info'], 200);
    }

    /**
     * Delete Endpoint for space crafts
     * @return Response
     */
    public function delete($id) : Response
    {
        $craft = SpaceCraft::find($id);

        if (!$craft) {
            return response()->json(['SpaceCraft Does not exist', 404]);
        }

        $craft->armaments()->detach();
        $craft->delete();

        return response()->json(['data' => 'Successfully Deleted craft :' . $id], 200);
    }

    /**
     * search for space craft filter by class / name / status
     * @param  Request $request
     * @return Response
     */
    public function findSpaceCraft(Request $request) : Response
    {
        $data = [
            'class' => 'required_without_all:name,status',
            'name' => 'required_without_all:class,status',
            'status' => 'required_without_all:class,name',
        ];

        $this->validate($request, $data);

        $class = $request->query('class');
        $name = $request->query('name');
        $status = $request->query('status');

        $new = new SpaceCraft();

        if (!$class) {
            $type = CraftTypes::where('name', $class)->first();

            if (!$type) {
                return response()->json(['Craft type does not exist', 404]);
            }            
        }

        $query = $new
            ->where('name', $request->get('name'))
            ->where('status', $request->get('status'))
        ;        

        if (!$class) {
            $query->where('craft_types_id', $type->id);
        }

        $result = $query->get()->map->only('name','status','id');
        return response()->json(['data' => $result], 200);
    }
}
