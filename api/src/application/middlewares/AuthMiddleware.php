<?php

namespace nrv\application\middlewares;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\application\providers\auth\JWTManager;

class AuthMiddleware{

    protected AuthProviderInterface $provider;

    public function __construct(AuthProviderInterface $p){
        $this->provider = $p;
    }

    public function __invoke(ServerRequestInterface $rq, RequestHandlerInterface $next ): ResponseInterface {


        if (! $rq->hasHeader('Origin'))
            New HttpUnauthorizedException ($rq, "missing Origin Header (auth)");
        if (! $rq->hasHeader("Authorization")){
            New HttpUnauthorizedException ($rq, "missing Authorization Header (auth)");
        }
        if(!isset($rq->getHeader('Authorization')[0])){
            throw new HttpUnauthorizedException($rq,"no auth, try /utilisateur/signin[/] or /utilisateur/signup[/]");
        }
        if(strlen($rq->getHeader('Authorization')[0]) == 6){
            throw new HttpUnauthorizedException($rq,"no auth, try /utilisateur/signin[/] or /utilisateur/signup[/]");
        }

        try{
            $h = $rq->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $utiOutDTO = $this->provider->getSignIn($tokenstring);


        }catch (ExpiredException $e) {
            throw new HttpUnauthorizedException($rq,"expired token");
        } catch (SignatureInvalidException $e) {
            throw new HttpUnauthorizedException($rq,"signature invalid token");
        } catch (BeforeValidException $e) {
            throw new HttpUnauthorizedException($rq,"before valid token");
        } catch (\UnexpectedValueException $e) {
            throw new HttpUnauthorizedException($rq,"unexpected value token");
        }

        $rq = $rq->withAttribute('UtiOutDTO',$utiOutDTO);

        $response = $next->handle($rq);
        return $response;
    }

}