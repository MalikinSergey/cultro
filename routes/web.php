<?php
Route::group(
    ['namespace' => '\Cultro\Http\Controllers', 'prefix' => config('cultro.route_prefix'), 'as' => config('cultro.route_prefix') . '.', 'middleware' => config('cultro.middleware')],

    function () {

        Route::get("/entity/touch/{type}", "EntityController@touch")->name("entity.touch");
        Route::get("/entity/create/{type}", "EntityController@create")->name("entity.create");
        Route::post("/entity/store", "EntityController@store")->name("entity.store");
        Route::get("/entity/edit/{type}/{id?}", "EntityController@edit")->name("entity.edit");
        Route::post("/entity/update/{id}", "EntityController@update")->name("entity.update");
        Route::get("/entities/{type}", "EntityController@index")->name("entity.index");
        Route::get("/entity/destroy/{id}", "EntityController@destroy")->name("entity.destroy");
        Route::post("/entity/set-positions", "EntityController@setPositions")->name("entity.set_positions");

    });
