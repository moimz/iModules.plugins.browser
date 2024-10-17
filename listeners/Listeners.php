<?php
/**
 * 이 파일은 아이모듈 브라우저 플러그인의 일부입니다. (https://www.imodules.io)
 *
 * 아이모듈코어 이벤트리스너를 정의한다.
 *
 * @file /plugins/browser/Listeners.php
 * @author Arzz <arzz@arzz.com>
 * @license MIT License
 * @modified 2024. 10. 17.
 */
namespace plugins\browser\listeners;
class Listeners extends \Event
{
    public static int $_priority = 1;

    /**
     * 테마가 공통 레이아웃을 생성하기전 발생한다.
     *
     * @param \Theme $theme 사이트테마클래스
     * @param string $main 공통 테마디자인에 포함될 콘텐츠
     * @param string $type 공통 레이아웃 타입 (NULL : 웹사이트, context : 컨텍스트)
     * @return ?string $html 테마 레이아웃 HTML (NULL 이 아닌 경우 해당 내용으로 테마 레이아웃을 대치한다.)
     */
    public static function beforeLayout(\Theme $theme, string &$main, ?string &$type): ?string
    {
        /**
         * @var \plugins\browser\Browser $pBrowser
         */
        $pBrowser = \Plugins::get('browser');

        /**
         * 아이모듈의 기본 브라우저 지원정책을 먼저 확인한다.
         */
        if ($pBrowser->getBrowserName() == 'IE') {
            return $pBrowser->updateMessage();
        } elseif ($pBrowser->getBrowserName() == 'Safari') {
            if ($pBrowser->getBrowserVersion() < 17) {
                return $pBrowser->updateMessage();
            }
        } elseif ($pBrowser->getBrowserName() == 'Chrome') {
            if ($pBrowser->getBrowserVersion() < 120) {
                return $pBrowser->updateMessage();
            }
        } elseif ($pBrowser->getBrowserName() == 'Firefox') {
            if ($pBrowser->getBrowserVersion() < 117) {
                return $pBrowser->updateMessage();
            }
        } elseif ($pBrowser->getBrowserName() == 'SamsungBrowser') {
            if ($pBrowser->getBrowserVersion() <= 25) {
                return $pBrowser->updateMessage();
            }
        }

        // @todo 사용자설정 버전 확인 추가

        return null;
    }
}
