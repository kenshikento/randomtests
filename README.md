Xanda Test

All spaceshifts allowing filtering name / class / status

{
 "data": [
 {
 "id": 1,
 "name": "Devastator",
 "status": "operational"
 },
 {
 "id": 2,
 "name": "Red Five",
 "status": "damaged"
 },
....
}



Single Response Space craft

{
 "id": 1,
 "name": "Devastator",
 "class": "Star Destroyer",
 "crew": 35000,
 "image": "https:\\url.to.image",
 "value": 1999.99,
 "status": "operational",
 "armament": [
 {
 "title": "Turbo Laser",
 "qty": "60"
 },
 {
 "title": "Ion Cannons",
 "qty": "60",
 },
 {
 "title": "Tractor Beam",
 "qty": "10",
 },
 ]
}


Create new spaceship

{
 "success": true
}


Edit update spaceship

{
 "success": true
}

Delete spaceship 
{
 "success": true
}

Under Assumption that 1 space ship will only have one type

// IDEALLY Weapons should be MANY TO MANY Relationship with pivot table