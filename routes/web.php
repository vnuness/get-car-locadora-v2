<?php



Route::get('', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('detalhes-veiculo/{id}',  'Veiculos\VeiculosController@detalheVeiculo')->name('veiculo.detalhe');
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::post('profile', 'ProfileController@update')->name('profile.update');
    Route::get('get-image', 'Veiculos\VeiculosController@getImage')->name('veiculos.get-image');
    Route::get('veiculos-all', 'Veiculos\VeiculosController@all')->name('veiculos.all');
    Route::resource('veiculos', 'Veiculos\VeiculosController');
    Route::get('pedidos-all', 'PedidosController@all')->name('pedidos.all');
    Route::post('pedidos/status', 'PedidosController@getStatus')->name('pedidos.get-status');
    Route::post('pedidos/salvar', 'PedidosController@saveStatus')->name('pedidos.save-status');
    Route::resource('pedidos', 'PedidosController');
});