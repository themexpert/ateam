<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.sef
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Joomla! SEF Plugin.
 *
 * @since  1.5
 */
class PlgAjaxATeam extends JPlugin
{
	public static function onAjaxATeam()
	{
		$input = JFactory::getApplication()->input;
		$name = $input->getString('name');
		$itemId = $input->get('itemId');
		$adminyes = $input->get('adminyes');
		
		return self::buildForm( $name, '',  $itemId, true , $adminyes);

	}

	public static function buildForm( $name, $data = array(), $itemId = 1, $ajax = false, $adminyes = false)
	{
			$html = array();

			if( empty($data) )
			{
					$data = array(
							0 => array(
									'name' => 'New Member',
									'designation' => '',
									'image' => '',
									'description' => '',
									'facebook' => '',
									'twitter' => '',
									'linkedin' => '',
									'gplus' => ''
							)
					);
			}

			JHtmlBootstrap::startAccordion('repeatable', array('active'=>'slide-1'));

			foreach ($data as $item)
			{
					$html[] = JHtmlBootstrap::addSlide('repeatable', '<i class="icon-menu"></i>' . '<span class="text">'. $item['name'] . '</span>' . '<span class="action-remove">X</span>', 'slide-' . $itemId );

					$html[] = '<div class="row-fluid">';
							$html[] = '<div class="span4">';
									$html[] = '<label>Name</label><input type="text" class="name input-xlarge" name="'. $name.'['.$itemId.'][name]" value="'. $item['name'].'" placeholder="John Doe">';
							$html[] = '</div>';

							$html[] = '<div class="span4">';
									$html[] = '<label>Designation</label><input type="text" class="input-large" name="'. $name.'['.$itemId.'][designation]" value="'. $item['designation'].'" placeholder="CEO, ACME">';
							$html[] = '</div>';

							$html[] = '<div class="span4">';
									$html[] = '<label>Image</label>';
									$html[] = '<div class="input-prepend input-append">
																	<input type="text" name="'. $name.'['.$itemId.'][image]" id="ateam_images_'.$itemId.'" value="'. $item['image'].'" readonly="readonly" class="input-large" aria-invalid="false">
															<a class="modal btn" title="Select" href="'.($adminyes ? 'administrator/' : '').'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;fieldid=ateam_images_'.$itemId.'" rel="{handler: \'iframe\', size: {x: 800, y: 500}}">
															Select</a>
															</div>';
							$html[] = '</div>';
					$html[] = '</div>';
					// Description
					$html[] = '<div class="row-fluid">';
							$html[] = '<div class="span12">';
									$html[] = '<label>Description</label><textarea rows="3" name="'. $name.'['.$itemId.'][description]">'.$item['description'].'</textarea>';
							$html[] = '</div>';
					$html[] = '</div>';
					// Social links
					$html[] = '<div class="row-fluid">';
							$html[] = '<div class="span3">';
									$html[] = '<label>Facebook</label><input class="input-medium" type="text" name="'. $name.'['.$itemId.'][facebook]" value="'. $item['facebook'].'" placeholder="https://facebook.com/ThemeXpert">';
							$html[] = '</div>';

							$html[] = '<div class="span3">';
									$html[] = '<label>Twitter</label><input class="input-medium" type="text" name="'. $name.'['.$itemId.'][twitter]" value="'. $item['twitter'].'" placeholder="https://twitter.com/ThemeXpert">';
							$html[] = '</div>';

							$html[] = '<div class="span3">';
									$html[] = '<label>Linkedin</label><input class="input-medium" type="text" name="'. $name.'['.$itemId.'][linkedin]" value="'. $item['linkedin'].'" placeholder="https://linkedin.com/ThemeXpert">';
							$html[] = '</div>';

							$html[] = '<div class="span3">';
									$html[] = '<label>Google+</label><input class="input-medium" type="text" name="'. $name.'['.$itemId.'][gplus]" value="'. $item['gplus'].'" placeholder="https://plus.google.com/ThemeXpert">';
							$html[] = '</div>';
					$html[] = '</div>';

					if( $ajax )
					{
							$html[] = "<script type='text/javascript'>
													jQuery(function($) {
																	SqueezeBox.initialize({});
																	SqueezeBox.assign($('a.modal').get(), {
																			parse: 'rel'
																	});
															});
													</script>";
					}

					$html[] = JHtmlBootstrap::endSlide();

					$itemId++;
			}
			JHtmlBootstrap::endAccordion();

			return implode('', $html);
	}
}
