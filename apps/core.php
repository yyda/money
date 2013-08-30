<?php 
/* */
$headers = $app->request()->headers();
$curr_url = $app->request()->getResourceUri();
$doc_root = $app->request()->getRootUri();
$protocal = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https' : 'http';
$full_doc_root = $protocal.'://'.$headers['HOST'].$doc_root;
 
// for app
$app->config('curr_url', $curr_url);
$app->config('doc_root', $doc_root);
$app->config('full_doc_root', $full_doc_root);
// for TwigView
$app->view()->setData('curr_url', $curr_url);
$app->view()->setData('doc_root', $doc_root);
$app->view()->setData('full_doc_root', $full_doc_root);
$app->view()->setData('link', '');
$app->view()->setData('project_name','ManageMoney');


/* Not Found Url Path & redirect 404 */
$app->notFound(function() use ($app) {
	$file=dirname(__FILE__).'/..'.$app->request()->getResourceUri();
	if (file_exists($file)) {
		$path=pathinfo($app->request()->getRootUri());
		$path=$path['dirname'];
		if ($path=='/'||$path=='\\') {
			$path='';
		}
		$app->redirect($path.$app->request()->getResourceUri());
		$app->stop();

	}
	$app->render('404.html',array('breadcrumb_title' => '404'));
});