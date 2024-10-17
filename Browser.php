<?php
/**
 * 이 파일은 아이모듈 브라우저 플러그인의 일부입니다. (https://www.imodules.io)
 *
 * 브라우저 플러그인 클래스 정의한다.
 *
 * @file /plugins/browser/Browser.php
 * @author Arzz <arzz@arzz.com>
 * @license MIT License
 * @modified 2024. 10. 17.
 */
namespace plugins\browser;
class Browser extends \Plugin
{
    /**
     * @var string $_browser 브라우저명 (IE, Edge, Chrome, Firefox, Safari, Opera, SamsungBrowser)
     */
    private static string $_browser;

    /**
     * @var int $_version 브라우저 메이저버전
     */
    private static int $_version;

    public function init(): void
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $browser = null;
        $version = null;
        if (preg_match('/(MSIE) ([0-9]+)/', $agent, $match) == true) {
            $browser = 'IE';
            $version = intval($match[2]);
        } elseif (preg_match('/(Edg)\/([0-9]+)/', $agent, $match) == true) {
            $browser = 'Edge';
            $version = intval($match[2]);
        } elseif (preg_match('/(OPR)\/([0-9]+)/', $agent, $match) == true) {
            $browser = 'Opera';
            $version = intval($match[2]);
        } elseif (preg_match('/(SamsungBrowser)\/([0-9]+)/', $agent, $match) == true) {
            $browser = 'SamsungBrowser';
            $version = intval($match[2]);
        } elseif (preg_match('/(Chrome)\/([0-9]+)/', $agent, $match) == true) {
            $browser = $match[1];
            $version = intval($match[2]);
        } elseif (preg_match('/(Firefox)\/([0-9]+)/', $agent, $match) == true) {
            $browser = $match[1];
            $version = intval($match[2]);
        } elseif (preg_match('/Version\/([0-9]+).*?(Safari)/', $agent, $match) == true) {
            $browser = $match[2];
            $version = intval($match[1]);
        }

        self::$_browser = $browser ?? 'Unknown';
        self::$_version = $version ?? 0;
    }

    /**
     * 브라우저명을 가져온다.
     *
     * @return string $browser 브라우저명 (IE, Edge, Chrome, Firefox, Safari, Unknown)
     */
    public function getBrowserName(): string
    {
        if (isset(self::$_browser) == false) {
            $this->init();
        }

        return self::$_browser;
    }

    /**
     * 브라우저명을 가져온다.
     *
     * @return int $version 브라우저 메이저버전
     */
    public function getBrowserVersion(): int
    {
        if (isset(self::$_version) == false) {
            $this->init();
        }

        return self::$_version;
    }

    /**
     * 브라우저 업데이트 메시지를 출력한다.
     *
     * @return string $message
     */
    public function updateMessage(): string
    {
        // @todo 디자인 및 언어팩 적용필요
        return '현재 접속하신 브라우저는 더이상 지원되지 않는 구버전 브라우저입니다.<br>최신 브라우저로 업데이트하신 후 다시 접속하여 주시기 바랍니다.';
    }
}
