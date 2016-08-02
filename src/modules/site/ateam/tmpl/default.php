<?php
/**
 * @package aTeam Module
 * @version ##VERSION##
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2010 - 2015 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined('_JEXEC') or die;
$i = 0;
?>

<div id="ateam-<?php echo $module->id; ?>" class="ateam at-<?php echo $params->get('layout');?>">
    <ul class="at-cols<?php echo $params->get('grid_cols');?>">
        <?php foreach( $params->get('teams') as $team ) : ?>
            <?php if( $i === (int)$params->get('grid_cols')):?>
                <div class="clear"></div>
            <?php $i=0; endif;?>
            <li>
                <div class="at-inner">
                    <?php if( !empty($team->image) ): ?>
                        <img class="<?php echo $params->get('image_style')?> img-responsive" src="<?php echo $team->image ;?>" alt="<?php echo $team->name; ?>">
                    <?php endif;?>
                    <h3 class="at-name"><?php echo $team->name; ?></h3>
                    <h4 class="at-designation"><?php echo $team->designation; ?></h4>
                    <?php if( !empty($team->description) ): ?>
                        <p class="at-desc"><?php echo $team->description; ?></p>
                    <?php endif; ?>
                    <?php if( $team->facebook OR $team->twitter OR $team->linkedin OR $team->gplus ):?>
                        <div class="at-social">
                            <?php if($team->facebook): ?>
                                <a href="<?php echo $team->facebook ?>" target="_blank"><span class="aticon-facebook"></span></a>
                            <?php endif;?>
                            <?php if($team->twitter): ?>
                                <a href="<?php echo $team->twitter ?>" target="_blank"><span class="aticon-twitter"></span></a>
                            <?php endif;?>
                            <?php if($team->linkedin): ?>
                                <a href="<?php echo $team->linkedin ?>" target="_blank"><span class="aticon-linkedin"></span></a>
                            <?php endif;?>
                            <?php if($team->gplus): ?>
                                <a href="<?php echo $team->gplus ?>" target="_blank"><span class="aticon-google"></span></a>
                            <?php endif;?>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php $i++; endforeach;?>
    </ul>
</div>
