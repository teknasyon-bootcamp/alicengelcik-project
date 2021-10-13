<?php
namespace App;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NoConfigurationException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router{
    public function __construct(protected RouteCollection $routeCollection)
    {
    }
    public function __invoke(){
        //sınıfın kendisi çağrılması durumunda çalışan method
         $request=new RequestContext();
         $matcher=new UrlMatcher($this->routeCollection,$request);
        try {
            $match=$matcher->match($_SERVER["REQUEST_URI"]);

            $classname=$match["controller"];
            $instance=new $classname;
            call_user_func_array([$instance,$match["method"]],array_slice($match,2,-1));
        }
        catch (MethodNotAllowedException $e) {
            die("Method doğru değil");
        } catch (NoConfigurationException $e){
            http_response_code(500);
            die("Sistemsel sorun 500!");
        } catch (ResourceNotFoundException $e){
            die("İlgili rota bulunamadı");
        }
    }
}