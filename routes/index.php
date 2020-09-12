<?php

Route::get("/", "FormController");


Route::get("/user", "UserController");
Route::get("/user/:id", "UserController@show");
Route::get("/user/:id/test/:id", "UserController@test");


Route::post("/user/:id/test/:id", "UserController@posts");
Route::post("/tqtq", "UserController@asdasd");
