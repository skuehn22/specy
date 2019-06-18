<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Mail;
use Redirect;
use Response;
use Action;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {



        if($this->isHttpException($e))
        {
            if(env("APP_ENV") == "local") {

                return parent::render($request, $e);


            } else {
                $test = "";
                switch ($e->getStatusCode()) {
                    // not found
                    case 404:


                        $str = $request." \n --------------- \n".$e;

                        Mail::raw($str, function ($message) {
                            $message->from('error@trustfy.io');
                            $message->subject("trustfy Error");
                            $message->to('sebastian@trustfy.io');
                        });


                        $data=array();

                        return response()->view('errors.404', $data)->setStatusCode(404); //for example
                        break;

                        break;
                    // internal error
                    case '500':



                        $str = $request." \n --------------- \n".$e;

                        Mail::raw($str, function ($message) {
                            $message->from('error@trustfy.io');
                            $message->subject("trustfy Error");
                            $message->to('sebastian@trustfy.io');
                        });


                        $content="<br><br><br><h2>Ooooops!</h2>";
                        $content.= "Fehler";
                        $content.="Fehler";
                        $content.="Fehler";
                        return Response::view('errors.503',compact('content', 'blade'));

                        break;

                    default:
                        $content="An error has occurred. The administrator of the page has been informed.";
                        return Response::view('errors.503',compact('content', 'blade'));
                        break;
                }
            }
        }
        else
        {
            if(env("APP_ENV") == "local") {

                return parent::render($request, $e);

            } else {

                $str = $request." \n --------------- \n".$e;

                Mail::raw($str, function ($message) {
                    $message->from('error@trustfy.io');
                    $message->subject("trustfy Error");
                    $message->to('sebastian@trustfy.io');
                });



                $content="An error has occurred. The administrator of the page has been informed.";
                return Response::view('errors.404',compact('content', 'blade'));

            }
        }
    }
}
