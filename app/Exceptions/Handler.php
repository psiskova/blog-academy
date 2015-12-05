<?php

namespace App\Exceptions;

use Exception;
use Flash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e) {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return Response
     */
    public function render($request, Exception $e) {
        if (config('app.debug')) {

            return $this->renderExceptionWithWhoops($e);
        } else {
            if (!$request->ajax()) {
                if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {

                    Flash::error('Neexistujúca stránka. Skontrolujte prosím adresu');
                }

                return redirect('/');
            }
        }

        return parent::render($request, $e);
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $e
     * @return Response
     */
    protected function renderExceptionWithWhoops(Exception $e) {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler());

        return new Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }
}
