<?php
/**
 * Author: Falaleev Maxim (max107)
 * Email: <max@studio107.ru>
 * Company: Studio107 <http://studio107.ru>
 * Date: 17/03/17 14:01
 */

namespace Mindy\Bundle\VideoBundle\Controller;


use Mindy\Bundle\MindyBundle\Controller\Controller;
use Mindy\Bundle\VideoBundle\Model\Video;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller
{
    public function listAction(Request $request)
    {
        $qs = Video::objects()->order(['-id']);
        $pager = $this->createPagination($qs, [
            'pageSize' => 12
        ]);

        return $this->render('video/list.html', [
            'videos' => $pager->paginate(),
            'pager' => $pager->createView()
        ]);
    }
}
