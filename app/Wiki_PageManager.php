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
    private function getDirectory()
    {
        return $this->backend->getController()->getDirectory('tmp');
    }

    private function getPath($pagename)
    {
        $dir = $this->getDirectory();
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

        $content = file_get_contents($this->getPath($pagename));
        return $this->escape($content);
    }

    private function escape($content)
    {
        $content = preg_replace('/\r\n/', "\n", $content);
        $content = preg_replace('/\r/', "\n", $content);
        $content = preg_replace('/\&/', '&amp;', $content);
        $content = preg_replace('/</', '&lt;', $content);
        $content = preg_replace('/>/', '&gt;', $content);
        $content = preg_replace('/"/', '&quot;', $content);
        return $content;
    }

    public function get($pagename)
    {
        $content = $this->getText($pagename);
        $content = $this->wikize($content);
        return $content;
    }


    private function wikize($content)
    {
        $pattern = '(((http|https|ftp):[\x21-\x7E]*)|('.WIKI_NAME.'))';
        return preg_replace_callback($pattern, array($this, 'makeLink'), $content);
    }

    private function makeLink($matches)
    {
        $_ = $matches[0];
        if (preg_match('/^(http|https|ftp):/', $_)) {
            return "<a href='$_'>$_</a>";
        } else if ($this->exists($_)) {
            return "<a href='?mypage=$_'>$_</a>";
        } else {
            return "$_<a href='?action_Edit=true&amp;mypage=$_'>?</a>";
        }
    }

    public function getList()
    {
        $dir = $this->getDirectory();
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

