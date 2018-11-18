<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace yii\authclient\clients;

/**
 * GoogleHybrid is an enhanced version of the [[Google]], which uses Google+ hybrid sign-in flow,
 * which relies on embedded JavaScript code to generate a sign-in button and handle user authentication dialog.
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 * 'authClientCollection' => [
 * 'class' => 'yii\authclient\Collection',
 * 'clients' => [
 * 'google' => [
 * 'class' => 'yii\authclient\clients\GoogleHybrid',
 * 'clientId' => 'google_client_id',
 * 'clientSecret' => 'google_client_secret',
 * ],
 * ],
 * ]
 * // ...
 * ]
 * ```
 *
 * Note: Google+ hybrid relies heavily on client-side JavaScript during authorization process, do not attempt to
 * obtain authorization code using [[buildAuthUrl()]] unless you absolutely sure, what you are doing.
 *
 * JavaScript button itself generated by [[yii\authclient\widgets\GooglePlusButton]] widget. If you are using
 * [[yii\authclient\widgets\AuthChoice]] it will appear automatically. Otherwise you need to add it into your page manually.
 * You may customize its appearance using 'widget' key at [[viewOptions]]:
 *
 * ```php
 * 'google' => [
 * // ...
 * 'viewOptions' => [
 * 'widget' => [
 * 'class' => 'yii\authclient\widgets\GooglePlusButton',
 * 'buttonHtmlOptions' => [
 * 'data-approvalprompt' => 'force'
 * ],
 * ],
 * ],
 * ],
 * ```
 *
 * @see Google
 * @see \yii\authclient\widgets\GooglePlusButton
 * @see https://developers.google.com/+/web/signin
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.4
 */
class GoogleHybrid extends Google
{

    /**
     *
     * {@inheritdoc}
     */
    public $validateAuthState = false;

    /**
     *
     * {@inheritdoc}
     */
    protected function defaultReturnUrl()
    {
        return 'postmessage';
    }

    /**
     *
     * {@inheritdoc}
     */
    protected function defaultViewOptions()
    {
        return [
            'widget' => [
                'class' => 'yii\authclient\widgets\GooglePlusButton'
            ]
        ];
    }
}