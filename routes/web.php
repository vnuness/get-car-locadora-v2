<?php

Route::get('', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('home', 'HomeController@index')->name('home');

    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::post('profile', 'ProfileController@update')->name('profile.update');
    Route::get('get-image', 'Veiculos\VeiculosController@getImage')->name('veiculos.get-image');
    Route::get('veiculos-all', 'Veiculos\VeiculosController@all')->name('veiculos.all');
    Route::any('detalhes-veiculo', 'Veiculos\VeiculosController@detalheVeiculo')->name('veiculo.detalhe');
    Route::resource('veiculos', 'Veiculos\VeiculosController');
});