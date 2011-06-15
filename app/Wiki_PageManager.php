<?php
/**
 *  Wiki_PageManager.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: a17b62fb78834da3c636228f401e740cd5bfdb64 $
 */

/**
 *  Wiki_PageManager
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_PageManager extends Ethna_AppManager
{
    private function getPath($pagename)
    {
        $dir = $this->backend->getController()->getDirectory('tmp');
        return $dir . '/' . $pagename;
    }

    private function exists($pagename)
    {
        return is_file($this->getPath($pagename));
    }

    public function set($pagename, $content)
    {
        $filepath = $this->getPath($pagename);
        return file_put_contents($filepath, $content);
    }

    public function delete($pagename)
    {
        if ($this->exists($pagename)) {
            return unlink($this->getPath($pagename));
        }

        return true;
    }

    public function getText($pagename)
    {
        if (!$this->exists($pagename)) {
            return '';
        }

        return file_get_contents($this->getPath($pagename));
    }

    public function get($pagename)
    {
        $content = $this->getText($pagename);
        $content = $this->wikize($content);
        return $content;
    }


    function wikize($content)
    {
        return preg_replace_callback(WIKI_RULE, array($this, 'makeLink'), $content);
    }

    function makeLink($matches)
    {
        $pagename = $matches[0];
        if ($this->exists($pagename)) {
            return "<a href='?mypage=$pagename'>$pagename</a>";
        } else {
            return "$pagename<a href='?action_Edit=true&amp;mypage=$pagename'>?</a>";
        }
    }

    public function getList()
    {
        $dir = $this->backend->getController()->getDirectory('tmp');
        $files = scandir($dir);

        $pages = array();
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (preg_match('/^[a-zA-Z]+$/', $file)) {
                $pages[] = $file;
            }
        }

        return $pages;
    }

}

