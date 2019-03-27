<?php

/**
 * Controller for Json Response
 * @file
 * Contains \Drupal\sahinul\Controller\PjController
 */

namespace Drupal\sahinul\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\NodeInterface;

class PjController extends ControllerBase {

    /*
    * This module also provides a URL that responds with a JSON representation 
    * of a given node with the content type "page" only if the previously submitted 
    * API Key and a node id (nid) of an appropriate node are present, otherwise it 
    * will respond with "access denied".
    */
    public static function page_json($apikey, NodeInterface $node) {
        if($apikey!=\Drupal::config('system.site')->get('siteapikey') || $node->bundle() !='page' ){
            throw new AccessDeniedHttpException();
        }

        //sending json response
        //handled XSSI and JSON-JavaScript Hijacking
        return new JsonResponse([
          'data' => [$node->toArray()],
        ]);
    }
}
