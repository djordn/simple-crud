<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Response; //Should be in Controller

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/users', function() {
    return \App\User::all();
});

$router->put('/user', function( Illuminate\Http\Request $req){

//    dd( $req->input('name') );

    try
    {

        $user = new App\User();

        $user->name = $req->input('name');
        $user->username = $req->input('username');

        $user->save();

        return response()->json([
            'data' => [
                'status' => 'SUCCESS',
                'message' => 'User created successfully!',
                'status_code' => Response::HTTP_CREATED,
            ]], Response::HTTP_CREATED , $headers = []);




    }catch (Exception $ex )
    {
//        return( $ex );
        return response()->json([
            'data' => [
                'status' => 'ERROR',
                'exception' => class_basename($ex),
                'message' => $ex->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]], Response::HTTP_BAD_REQUEST, $headers = []);

    }

});

$router->post('/user', function ( Illuminate\Http\Request $req){
    try
    {

        $user = App\User::where('username', $req->input('username') )->first();

        $user->name = $req->input('name');
        $user->username = $req->input('username');

        $user->update();

        return response()->json([
            'data' => [
                'status' => 'SUCCESS',
                'message' => 'User updated successfully!',
                'status_code' => Response::HTTP_CREATED,
            ]], Response::HTTP_CREATED , $headers = []);


    }catch (Exception $ex )
    {
//        return( $ex );
        return response()->json([
            'data' => [
                'status' => 'ERROR',
                'exception' => class_basename($ex),
                'message' => $ex->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]], Response::HTTP_BAD_REQUEST, $headers = []);

    }

});

$router->delete('/user/{user_id}', function (  $user_id ){
    try
    {

        $user = App\User::find( $user_id );

        if( empty($user) ){


            return response()->json([
                'data' => [
                    'status' => 'ERROR',
                    'exception' => 'Not found Exception',
                    'message' => 'Resource not found',
                    'status_code' => Response::HTTP_NOT_FOUND,
                ]], Response::HTTP_NOT_FOUND, $headers = []);


        }

        $user->delete();

        return response()->json([
            'data' => [
                'status' => 'SUCCESS',
                'message' => 'User deleted successfully!',
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]],  Response::HTTP_BAD_REQUEST, $headers = []);


    }catch (Exception $ex )
    {
//        return( $ex );
        return response()->json([
            'data' => [
                'status' => 'ERROR',
                'exception' => class_basename($ex),
                'message' => $ex->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]], Response::HTTP_BAD_REQUEST, $headers = []);

    }

});