<?php
/**
 * Name: Custom CSS Injector
 * Description: Allows site admin to inject global custom CSS via the admin panel.
 * Version: 1.4.2
 * Author: Vibrillo Team
 * Maintainer: Vibrillo Social <https://github.com/VibrilloSocial>
 */

use Friendica\Core\Hook;
use Friendica\DI;

function customcss_install()
{
    Hook::register('head', __FILE__, 'customcss_head');
    Hook::register('addon_settings', __FILE__, 'customcss_addon_settings');
    Hook::register('addon_settings_post', __FILE__, 'customcss_addon_settings_post');
}

function customcss_module()
{
    return;
}

function customcss_addon_settings(&$s)
{
    if (!DI::userSession()->isSiteAdmin()) {
        return;
    }

    $baseurl = (string)DI::baseUrl();
    $s .= '<li class="settings-block">';
    $s .= '<a href="' . $baseurl . '/admin/addons/customcss">' . DI::l10n()->t('Custom CSS') . '</a>';
    $s .= '</li>';
}

function customcss_addon_settings_post()
{
    if (!DI::userSession()->isSiteAdmin() || empty($_POST['customcss-submit'])) {
        return;
    }

    $css = trim($_POST['customcss-css'] ?? '');
    DI::config()->set('customcss', 'css', $css);
    DI::sysmsg()->addInfo(DI::l10n()->t('Custom CSS saved.'));
}

function customcss_addon_admin(&$o)
{
    if (!DI::userSession()->isSiteAdmin()) {
        return;
    }

    $baseurl = (string)DI::baseUrl();
    $customcss = DI::config()->get('customcss', 'css', '');
    $o = '<div class="settings-block">';
    $o .= '<h3>' . DI::l10n()->t('Custom CSS Injector') . '</h3>';
    $o .= '<form action="' . $baseurl . '/admin/addons/customcss" method="post">';
    $o .= '<label for="customcss-css">' . DI::l10n()->t('Custom CSS') . '</label><br>';
    $o .= '<textarea id="customcss-css" name="customcss-css" rows="10" cols="80" style="width:100%;">' . htmlspecialchars($customcss) . '</textarea><br>';
    $o .= '<input type="submit" name="customcss-submit" value="' . DI::l10n()->t('Save') . '" />';
    $o .= '</form>';
    $o .= '</div>';
}

function customcss_addon_admin_post()
{
    if (!DI::userSession()->isSiteAdmin() || empty($_POST['customcss-submit'])) {
        return;
    }

    $css = trim($_POST['customcss-css'] ?? '');
    DI::config()->set('customcss', 'css', $css);
    DI::sysmsg()->addInfo(DI::l10n()->t('Custom CSS saved.'));
}

function customcss_head(&$o)
{
    $css = DI::config()->get('customcss', 'css', '');
    if (!empty($css)) {
        $o .= '<style id="customcss-injector">' . $css . '</style>';
    }
}
