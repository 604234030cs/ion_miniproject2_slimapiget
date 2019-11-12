<?php
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json",true);


// get all todos
    $app->get('/todos', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Retrieve todo with id 
    $app->get('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });
 
 
    // Search for todo with given search teram in their name
    // $app->get('/todos/search/[{query}]', function ($request, $response, $args) {
    //      $sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
    //     $query = "%".$args['query']."%";
    //     $sth->bindParam("query", $query);
    //     $sth->execute();
    //     $todos = $sth->fetchAll();
    //     return $this->response->withJson($todos);
    // });
 
    // Add a new todo
    $app->post('/todo', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO tasks (task) VALUES (:task)";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson($input);
    });
        
 
    // DELETE a todo with given id
    $app->delete('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Update todo with given id
    $app->put('/todo/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE tasks SET task=:task WHERE id=:id";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $args['id'];
        return $this->response->withJson($input);
    });

    $app->get('/types', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM type ORDER BY id_type");
       $sth->execute();
       $types = $sth->fetchAll();
       return $this->response->withJson($types);
   });

   $app->get('/members', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM member ORDER BY id_member");
   $sth->execute();
   $members = $sth->fetchAll();
   return $this->response->withJson($members);
});

    $app->get('/apartment', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
  
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture
WHERE rentedroom.id_type = type.id_type AND type.id_type LIKE 't0002%' AND rentedroom.id_rentedroom = picture.id_rentedroom");
   $sth->execute();
   $apartment = $sth->fetchAll();
   return $this->response->withJson($apartment);
});
$app->get('/Mansion', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture
WHERE rentedroom.id_type = type.id_type AND type.id_type LIKE 't0003%' AND rentedroom.id_rentedroom = picture.id_rentedroom");  
   $sth->execute();
   $Mansion = $sth->fetchAll();
   return $this->response->withJson($Mansion);
});
$app->get('/dorm', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,   
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture
WHERE rentedroom.id_type = type.id_type AND type.id_type LIKE 't0004%' AND rentedroom.id_rentedroom = picture.id_rentedroom");
   $sth->execute();
   $dorm = $sth->fetchAll();
   return $this->response->withJson($dorm);
});

$app->get('/condominiums', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT  
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture
WHERE rentedroom.id_type = type.id_type AND type.id_type LIKE 't0001%' AND rentedroom.id_rentedroom = picture.id_rentedroom");
   $sth->execute();
   $condominiums = $sth->fetchAll();
   return $this->response->withJson($condominiums);
});

// $app->get('/aparts/search/[{query}]', function ($request, $response, $args) {
//     $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE UPPER(name_rentedroom) LIKE :query ORDER BY name_rentedroom");
//    $query = "%".$args['query']."%";
//    $sth->bindParam("query", $query);
//    $sth->execute();
//    $aparts = $sth->fetchAll();
//    return $this->response->withJson($aparts);
// });

$app->get('/room3000', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture 
WHERE rentedroom.id_type = type.id_type  AND rentedroom.id_rentedroom = picture.id_rentedroom AND rentedroom.price < 3000;");
   $sth->execute();
   $mansionprice = $sth->fetchAll();
   return $this->response->withJson($mansionprice);
});

$app->get('/room3001', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture 
WHERE rentedroom.id_type = type.id_type AND rentedroom.id_rentedroom = picture.id_rentedroom AND rentedroom.price BETWEEN '3000%' AND '4000%';");
   $sth->execute();
   $mansionpricea = $sth->fetchAll();
   return $this->response->withJson($mansionpricea);
});

$app->get('/room4000', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.id_rentedroom,
	rentedroom.name_rentedroom,
	rentedroom.address_rentedroom,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.id_picture,
	type.name_type,
	rentedroom.restrict_gender,
	rentedroom.phone_rentedroom
FROM rentedroom, type, picture 
WHERE rentedroom.id_type = type.id_type  AND rentedroom.id_rentedroom = picture.id_rentedroom AND rentedroom.price > 4000;");
   $sth->execute();
   $mansionprice = $sth->fetchAll();
   return $this->response->withJson($mansionprice);
});

$app->get('/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE name_rentedroom LIKE :query ORDER BY name_rentedroom");
   $query = "%".$args['query']."%";
   $sth->bindParam("query", $query);
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});

// $app->get('/search/[{query}]', function ($request, $response, $args) {
//     $sth = $this->db->prepare("SELECT 
//     rentedroom.id_rentedroom,
// 	rentedroom.name_rentedroom,
// 	rentedroom.address_rentedroom,
// 	rentedroom.price,
// 	rentedroom.facilities,
//     picture.name,
// 	type.name_type,
// 	rentedroom.restrict_gender,
// 	rentedroom.phone_rentedroom 
//     FROM rentedroom,  type, picture
//     WHERE name_rentedroom LIKE :query ORDER BY name_rentedroom AND name_rentedroom LIKE :query = rentedroom.name_rentedroom AND rentedroom.id_rentedroom = picture.id_rentedroom ");
//    $query = "%".$args['query']."%";
//    $sth->bindParam("query", $query);
//    $sth->execute();
//    $todos = $sth->fetchAll();
//    return $this->response->withJson($todos);
// });

$app->get('/room', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom ");
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});


// $app->get('/showroom/[{name_rentedroom}]', function ($request, $response, $args) {
//     $sth = $this->db->prepare("SELECT
// 	type.name_type,
// 	rentedroom.name_rentedroom,
// 	rentedroom.id_rentedroom,
// 	rentedroom.address_rentedroom,
// 	rentedroom.price,   
// 	rentedroom.facilities,
// 	rentedroom.phone_rentedroom,
// 	rentedroom.id_picture
// FROM rentedroom,type
// WHERE rentedroom.id_type=type.id_type AND name_rentedroom like :name_rentedroom");
//    $sth->bindParam("name_rentedroom", $args['name_rentedroom']);
//    $sth->execute();
//    $rooms = $sth->fetchObject();
//    return $this->response->withJson($rooms);
// });
$app->get('/showroom/[{name_rentedroom}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE name_rentedroom LIKE :name_rentedroom ORDER BY name_rentedroom");
   $query = "%".$args['name_rentedroom']."%";
   $sth->bindParam("name_rentedroom", $query);
   $sth->execute();
   $todos = $sth->fetchAll();                                           
   return $this->response->withJson($todos);
});

