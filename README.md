Random test

You are R3-D3 and were just appointed the general of the imperial fleet. Your fist action as the new
general is to digitalise the imperial fleet inventory.
You know that each spacecraft has the following characteristics:
- Name
- Class
- Armament
- Crew
- Image
- Value
- Status
You need to create a galactic database (using MySQL) that stores all the spacecraft’s details.
Then create a galactic application programming interface (REST API) in droidspeak (Laravel/Lumen)
that will handle the following:

Code requirements:
* Design and create a MySQL database with tables to fit all the fields and data types based on
the examples above.
* Ensure your code is tidy and well documented
* All endpoints must return a JSON response
* Add validation to all endpoints where applicable



All spaceshifts allowing filtering name / class / status
`
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
`


Single Response Space craft
`
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
`

Create new spaceship
`
{
 "success": true
}
`

Edit update spaceship
`
{
 "success": true
}
`

Delete spaceship 
`
{
 "success": true
}
`

Run Locally 
`php -S localhost:8000 -t public`

Integration Testing 
`./vendor/bin/phpunit tests/Intergration/SpaceCraftController.php`