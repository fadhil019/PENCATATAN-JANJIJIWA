<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
// Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('/');
Route::get('home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Route::resource('/','PeriodeController');
Route::resource('periode','PeriodeController');
Route::resource('listsales','ListSalesController');
Route::resource('jenissales','JenisSalesController');
Route::resource('dailyexpenses','DailyExpensesController');
Route::resource('monthlyexpenses','MonthlyExpensesController');
Route::resource('halamanlist','HalamanListController');
Route::resource('persentase','PersentasekaskeciloverheadController');
Route::resource('cashflow','CashflowController');
Route::get('cetak_pdf','CashflowController@cetak_pdf');
Route::get('cetak_listsales','HalamanListController@cetaklistsales');
Route::get('cetak_listdaily','HalamanListController@cetaklistdaily');
Route::get('cetak_listmonthly','HalamanListController@cetaklistmonthly');
Route::get('cetak_gaji','PegawaiController@cetakgajipegawai');
Route::resource('listdaily','ListExpensesController');
Route::resource('profitsharing','ProfitSharingController');

Route::get('halamanupdatepersentase','PersentasekaskeciloverheadController@edit');
Route::get('listsales2','ListSalesController@listsales2');
// Route::get('updatepersentase/update/{idpersentasekas}/{idpersentaseover}','PersentasekaskeciloverheadController@update');



Route::get('tambahperiode', 'PeriodeController@tambahperiode')->name('tambahperiode');
Route::get('exists', 'PeriodeController@periodeexists')->name('periodeexists');
Route::get('tolistdaily', 'HalamanListController@tohalamanlistdaily')->name('tolistdaily');
Route::get('tolistmonthly', 'HalamanListController@tohalamanlistmonthly')->name('tolistmonthly');
Route::get('tolistjenissales', 'HalamanListController@tohalamanlistjenissales')->name('tolistjenissales');
Route::get('tohalamanlistprofitsharing', 'HalamanListController@tohalamanlistprofitsharing')->name('tohalamanlistprofitsharing');


Route::post('perhitungandaily', 'TotalDailyExpensesController@perhitungandaily')->name('perhitungandaily');
Route::post('perhitunganmonthly', 'TotalDailyExpensesController@perhitunganmonthly')->name('perhitunganmonthly');
Route::post('perhitungansales', 'TotalDailyExpensesController@perhitungansales')->name('perhitungansales');

Route::get('simpantotaldaily/simpan/{flag}/{id}/{jumlah}','TotalDailyExpensesController@store');
Route::get('simpantotalmonthly/simpan/{flag}/{id}/{jumlah}','TotalDailyExpensesController@simpantotalmonthly');
Route::get('simpantotalsales/simpan/{flag}/{id}/{jumlah}','TotalDailyExpensesController@simpantotalsales');

Route::get('updatelistcashflow/simpan/{totalsales}/{totalppn}/{totalmonthly}/{totaldaily}/{jumlahtotalexpenses}/{totalsalesminexpenses}/{jumlahpersentaseover}/{jumlahpersentasekas}/{jumlahtotalmisexpenses}/{jumlahtotalprofit}/{idtotalsales}/{idlistexpenses}/{idtotalexpenses}/{idtotalsalesminexpenses}/{idlistmiscexpenses}/{idtotalmiscexpenses}/{idtotalprofit}','CashflowController@updatelistcashflow');

Route::get('halamanlistsales', 'PeriodeController@halamanlistsales')->name('halamanlistsales');
Route::get('halamanparsinglistsales', 'PeriodeController@halamanparsinglistsales')->name('halamanparsinglistsales');

Route::post('halamanlistpilihan', 'HalamanListController@tohalamanlistpilihan')->name('halamanlistpilihan');
Route::get('tolistsales', 'HalamanListController@tohalamanlistsales')->name('tolistsales');
Route::post('halamanlistcashflow', 'CashflowController@listcashflow')->name('halamanlistcashflow');
Route::get('tambahjenissales', 'JenisSalesController@tambahjenissales')->name('tambahjenissales');


//list lengkap cashflow
Route::get('listlengkapsales/list/{id}', 'HalamanListController@tolistlengkapsales');
Route::get('listlengkapdaily/', 'HalamanListController@tolistlengkapdaily');
Route::get('listlengkapmonthly/', 'HalamanListController@tolistlengkapmonthly');



///BAGIAN DELETE
Route::get('dailylist/destroy/{id}', 'ListExpensesController@destroy');
Route::get('monthlylist/destroy/{id}', 'ListExpensesController@hapusmonthlylist');
Route::get('saleslist/destroy/{id}', 'ListExpensesController@hapussaleslist');
Route::get('profitsharinglist/destroy/{id}', 'ListExpensesController@hapusprofitsharing');

//BAGIAN EDIT
Route::get('saleslist/halamanedit/{id}', 'ListExpensesController@halamaneditlistsales');
Route::get('dailylist/halamanedit/{id}', 'ListExpensesController@halamaneditlistdaily');
Route::get('monthlylist/halamanedit/{id}', 'ListExpensesController@halamaneditlistmonthly');
Route::get('saleslist/edit/{id}', 'ListExpensesController@editlistsales');
Route::get('saleslist/hitung/{idjenis}/{idlist}', 'ListExpensesController@editlistsaleshitung');
Route::get('dailylist/edit/{id}', 'ListExpensesController@editlistdaily');
Route::get('monthlylist/edit/{id}', 'ListExpensesController@editlistmonthly');
Route::get('profitsharinglist/halamanedit/{id}', 'ListExpensesController@halamaneditlistprofitsharing');
Route::get('profitsharinglist/edit/{id}', 'ListExpensesController@editlistprofitsharing');


//bagian gaji
Route::resource('pegawai','PegawaiController');
Route::resource('kriteriagaji','KriteriagajipegawaiController');
Route::get('buatpegawai','PegawaiController@buatpegawai')->name('buatpegawai');
Route::get('createlistkriteriapegawai','KriteriagajipegawaiController@store')->name('createlistkriteriapegawai');
Route::get('createlistgajipegawai/{idpegawai}','ListgajipegawaiController@create')->name('createlistgajipegawai');
Route::get('simpangajipegawai/{idpegawai}','ListgajipegawaiController@store')->name('simpangajipegawai');
Route::get('createpegawai','PegawaiController@createpegawai')->name('createpegawai');
Route::get('listkriteriapegawai/{idpegawai}','PegawaiController@listkriteriapegawai');
Route::get('kriteriagaji/destroy/{id}','KriteriagajipegawaiController@destroy');
Route::get('kriteriagaji/indexedit/{id}','KriteriagajipegawaiController@indexeditkriteriagaji');
Route::get('backkriteriagaji', 'KriteriagajipegawaiController@backkriteriagaji')->name('backkriteriagaji');
Route::get('updatelisttotalgaji/{tepatwaktu}/{lembur}/{bonusbulanan}/{bonusontime}/{totalgaji}/{idlistgaji}/{idtotalgaji}','ListgajipegawaiController@update');
Route::get('indexgajipokok','PegawaiController@indexgajipokok');
Route::get('isigajipokok','PegawaiController@isigajipokok');
Route::get('indexeditgajipokok','PegawaiController@indexeditgajipokok');
Route::get('updategajipokok/{idgajitepatwaktu}/{idgajibulanancup}/{idgajilembur}/{idgajiontime}','PegawaiController@updategajipokok');
Route::get('editkriteriagaji/{id}','KriteriagajipegawaiController@editkriteriagaji');
