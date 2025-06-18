use App\Http\Controllers\Api\PortfolioController;

Route::get('/portfolio', [PortfolioController::class, 'index']);
