<?php
defined('_JEXEC') or die();
$categories = $displayData['categories'];
$media_categories = '';

$app = JFactory::getApplication();
$support = $app->input->post->get('support', 'image', 'STRING');
$type = $app->input->post->get('type', '*', 'STRING');

$media_categories .= '<li class="item item-level-2'. (($type == '*') ? ' active' : '') .'"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-all" data-type="*" data-icon-name="fas fa-file fa-fw"><i class="fas fa-file fa-fw"></i> All Items <span>'. ((isset($categories['all']) && $categories['all']) ? $categories['all'] : 0) .'</span></a></li>';
$media_categories .= '<li class="item item-level-2'. (($type == 'image') ? ' active' : '') .'"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-image" data-type="image" data-icon-name="fas fa-image fa-fw"><i class="fas fa-image fa-fw"></i> Images <span>'. ((isset($categories['image']) && $categories['image']) ? $categories['image'] : 0) .'</span></a></li>';
$media_categories .= '<li class="item item-level-2'. (($type == 'video') ? ' active' : '') .'"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-video" data-type="video" data-icon-name="fas fa-film fa-fw"><i class="fas fa-film fa-fw"></i> Videos <span>'. ((isset($categories['video']) && $categories['video']) ? $categories['video'] : 0) .'</span></a></li>';
$media_categories .= '<li class="item item-level-2'. (($type == 'audio') ? ' active' : '') .'"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-audio" data-type="audio" data-icon-name="fas fa-music fa-fw"><i class="fas fa-music fa-fw"></i> Audios <span>'. ((isset($categories['audio']) && $categories['audio']) ? $categories['audio'] : 0) .'</span></a></li>';
$media_categories .= '<li class="item item-level-2'. (($type == 'attachment') ? ' active' : '') .'"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-attachment" data-type="attachment" data-icon-name="fas fa-paperclip fa-fw"><i class="fas fa-paperclip fa-fw"></i> Attachments <span>'. ((isset($categories['attachment']) && $categories['attachment']) ? $categories['attachment'] : 0) .'</span></a></li>';
if($support == 'image') {
	$media_categories .= '<li class="item item-level-2"><a href="#" class="sp-pagebuilder-browse-media sp-pagebuilder-browse-folders" data-type="folders" data-icon-name="fas fa-folder-open fa-fw" data-joomla3="true"><i class="fas fa-folder-open fa-fw"></i> Browse Folders <span>...</span></a></li>';
}

echo $media_categories;
