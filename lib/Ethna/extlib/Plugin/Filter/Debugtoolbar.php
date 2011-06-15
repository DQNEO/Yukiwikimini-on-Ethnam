<?php
/**
 *  Ethna_Plugin_Filter_DebugToolbar.php
 *
 *  @author     Sotaro KARASAWA <sotaro.k@gmail.com>
 *  @package    Ether
 */

/**
 *  DebugToolbar Plugin Filter
 *
 *  @description    DebugToolbar plugin standard set
 *  @author         Sotaro KARASAWA <sotaro.k@gmail.com>
 *  @access         public
 *  @package        Ethna_Plugin_Filter_DebugToolbar
 */
class Ethna_Plugin_Filter_Debugtoolbar extends Ethna_Plugin_Filter
{
    var $version = '0.9.1 - $Id: Debugtoolbar.php 1015 2009-07-16 17:18:46Z sotarok $';

    var $type_mapping = array(
        VAR_TYPE_INT      => 'VAR_TYPE_INT',
        VAR_TYPE_FLOAT    => 'VAR_TYPE_FLOAT',
        VAR_TYPE_STRING   => 'VAR_TYPE_STRING',
        VAR_TYPE_DATETIME => 'VAR_TYPE_DATETIME',
        VAR_TYPE_BOOLEAN  => 'VAR_TYPE_BOOLEAN',
        VAR_TYPE_FILE     => 'VAR_TYPE_FILE',
    );

    var $form_type_mapping = array(
        FORM_TYPE_TEXT     => 'FORM_TYPE_TEXT',
        FORM_TYPE_PASSWORD => 'FORM_TYPE_PASSWORD',
        FORM_TYPE_TEXTAREA => 'FORM_TYPE_TEXTAREA',
        FORM_TYPE_SELECT   => 'FORM_TYPE_SELECT',
        FORM_TYPE_RADIO    => 'FORM_TYPE_RADIO',
        FORM_TYPE_CHECKBOX => 'FORM_TYPE_CHECKBOX',
        FORM_TYPE_SUBMIT   => 'FORM_TYPE_SUBMIT',
        FORM_TYPE_FILE     => 'FORM_TYPE_FILE',
        FORM_TYPE_BUTTON   => 'FORM_TYPE_BUTTON',
        FORM_TYPE_HIDDEN   => 'FORM_TYPE_HIDDEN',
    );

    /**
     *  filter which will be executed at the end.
     *
     *  @access public
     */
    function postFilter()
    {
        if (!$this->ctl->view->has_default_header) {
            return null;
        }

        $this->init();
        $this->dumpInfo();
        $this->dumpConfig();
        $this->dumpActionForm();
        $this->smartyDebug();

    }

    function init()
    {
        $url = $this->ctl->getConfig()->get('url');
        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        // jquery がロードされてるかどうか調べる
        // なければ google.load
        // めんどくせー常にloadでいい？
        echo <<<EOL
<link rel="stylesheet" href="{$url}Debugtoolbar/css/ether.css" type="text/css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("jquery", "1.2");
</script>
<script type="text/javascript" src="{$url}Debugtoolbar/js/jquery.cookie.js"></script>
EOL;

        echo <<<EOL
<script type="text/javascript">
//jQuery.noConflict();
jQuery(function()
{

    var buttonOutline = document.createElement('ul');
    jQuery(buttonOutline).attr('id', 'ethna-debug-switch-outline');
    jQuery('html > body').append(buttonOutline);

    var buttonEthna = document.createElement('li');
    jQuery(buttonEthna).attr('id', 'ethna-debug-switch-Ethna');
    jQuery(buttonEthna).attr('class', 'ethna-debug-switch');
    jQuery(buttonEthna).text("Ethna");
    jQuery(buttonOutline).append(buttonEthna);

    var state = {};

    jQuery('.ethna-debug').each(function()
    {
        var name = jQuery(this).children('div.ethna-debug-title').text();
        //var stateName = ^

        var showMessage = ' ' + name;
        var hideMessage = ' ' + name;
        state[name] = false;

        var targetId = jQuery(this).attr('id');
        var buttonId = 'ethna-debug-switch-' + name;
        var button = document.createElement('li');
        jQuery(button).attr('id', buttonId);
        jQuery(button).attr('class', 'ethna-debug-switch');
        jQuery(button).text(showMessage);

        jQuery(button).click(function()
        {
            jQuery('.ethna-debug').each(function()
            {
                jQuery(this).hide();
                var local_name = jQuery(this).children('div.ethna-debug-title').text();

                if (name != local_name) {
                    state[local_name] = false;
                    jQuery.cookie(local_name, 0);
                }
            });

            if (!state[name]) {
                jQuery(this).text(hideMessage);
                //jQuery('#ethna-debug-logwindow').show();
                jQuery('#' + targetId).show();
                jQuery.cookie(name, 1);
                state[name] = true;
            }
            else {
                jQuery(this).text(showMessage);
                //jQuery('#ethna-debug-logwindow').hide();
                jQuery('#' + targetId).hide();
                jQuery.cookie(name, 0);
                state[name] = false;
            }
        });


        jQuery(button).hover(function()
        {
            jQuery(this).css('cursor', 'pointer');
        },
        function()
        {
            jQuery(this).css('cursor', 'default');
        });

        jQuery(buttonOutline).append(button);

        if (jQuery.cookie(name) == 1) {
            jQuery('#' + targetId).show();
            state[name] = true;
        }

        // log window coloring
        if(jQuery('#' + targetId)
            .is(":has('.ethna-debug-log-EMERG,.ethna-debug-log-ALERM,.ethna-debug-log-CRIT,.ethna-debug-log-ERR,.ethna-debug-log-WARNING,.ethna-debug-log-NOTICE')"))
        {
            jQuery(button).css('background-color', "#f00")
                .css('color', "#fff");
        }
    });


    // close button
    var closeButtonEthna = document.createElement('li');
    jQuery(closeButtonEthna).attr('id', 'ethna-debug-switch-EthnaClose');
    jQuery(closeButtonEthna).attr('class', 'ethna-debug-switch');
    jQuery(closeButtonEthna).text("close");
    jQuery(closeButtonEthna).click(function(e) {
        jQuery(buttonOutline).hide();
        return false;
    });
    jQuery(buttonOutline).append(closeButtonEthna);

});
</script>
EOL;
        echo '<div class="ethna-debug" id="ethna-debug-evwindow">';
        echo '<div class="ethna-debug-title">' . ETHNA_VERSION . ' : ' . $this->controller->action_name . '</div>';
        echo "<div class=\"ethna-debug-log\">";
        echo ETHNA_VERSION;
        echo "</div> \n";
        echo "<div class=\"ethna-debug-log\">";
        echo "Ethna_Plugin_Debugtoolbar Version" . $this->version;
        echo "</div> \n";
        echo '</div>';
    }

    /**
     * dump php info
     *
     * @access  public
     */
    function dumpInfo()
    {
        echo '<div class="ethna-debug" id="ethna-debug-infowindow">';
        echo '<div class="ethna-debug-title">Info</div>';
        echo "<div class=\"ethna-debug-log\">";

        echo '<div class="ethna-debug-subtitle">PHPINFO</div>';
        echo '<div class="ethna-debug-subtitle" id="ethna-debug-info-env-title"><a href="javascript:;">Environment &gt;&gt;</a></div>';
        echo '<div id="ethna-debug-info-env" style="display:none;">';
        echo $this->parsePHPInfo(INFO_ENVIRONMENT);
        echo "</div> \n";

        echo '<div class="ethna-debug-subtitle" id="ethna-debug-info-var-title"><a href="javascript:;">Variables &gt;&gt;</a></div>';
        echo '<div id="ethna-debug-info-var" style="display:none;">';
        echo $this->parsePHPInfo(INFO_VARIABLES);
        echo "</div> \n";

        echo '<div class="ethna-debug-subtitle" id="ethna-debug-info-modules-title"><a href="javascript:;">Installed Modules &gt;&gt;</a></div>';
        echo '<div id="ethna-debug-info-modules" style="display:none;">';
        echo $this->parsePHPInfo(INFO_MODULES);
        //$this->dumpArray(get_loaded_extensions());
        echo "</div> \n";

        echo <<<EOF
<script type="text/javascript">
jQuery(function()
{
    jQuery("#ethna-debug-info-env-title a").click(function() {
        jQuery("#ethna-debug-info-env").toggle();
    });
    jQuery("#ethna-debug-info-var-title a").click(function() {
        jQuery("#ethna-debug-info-var").toggle();
    });
    jQuery("#ethna-debug-info-modules-title a").click(function() {
        jQuery("#ethna-debug-info-modules").toggle();
    });
});
</script>
EOF;

        echo "</div> \n";
        echo '</div>';

    }


    function parsePHPInfo($info)
    {
        ob_start();
        $phpinfo = phpinfo($info);
        $info = ob_get_contents();
        ob_end_clean();

        $info_html = @simplexml_import_dom(DOMDOcument::loadHTML($info));
        $body = $info_html->xpath("//body");
        return preg_replace("/<table/", "<table class=\"ethna-debug-table ethna-debug-table-info\"", $body[0]->asXML());
    }

    /**
     * dump action form defined values and posted values
     *
     * @access  public
     */
    function dumpActionForm()
    {
        echo '<div class="ethna-debug" id="ethna-debug-afwindow">';
        echo '<div class="ethna-debug-title">ActionForm</div>';
        echo '<div class="ethna-debug-subtitle">Posted Value</div>';
        echo "<div class=\"ethna-debug-log\">";
        //var_dump($this->controller->action_form->getArray());
        self::dumpArray($this->controller->action_form->getArray());
        echo "</div> \n";
        echo '<div class="ethna-debug-subtitle">Definition</div>';
        echo "<div class=\"ethna-debug-log\">";
        //var_dump($this->controller->action_form->getArray());
        self::dumpArray($this->controller->action_form->form);
        echo "</div> \n";
        echo '<div class="ethna-debug-subtitle">$_GET</div>';
        echo "<div class=\"ethna-debug-log\">";
        //var_dump($this->controller->action_form->getArray());
        self::dumpArray($_GET);
        echo "</div> \n";
        echo '<div class="ethna-debug-subtitle">$_POST</div>';
        echo "<div class=\"ethna-debug-log\">";
        //var_dump($this->controller->action_form->getArray());
        self::dumpArray($_POST);
        echo "</div> \n";
        echo '</div>';
    }

    function dumpConfig()
    {
        $config = $this->controller->getConfig();
        echo '<div class="ethna-debug" id="ethna-debug-configwindow">';
        echo '<div class="ethna-debug-title">Config</div>';
        echo "<div class=\"ethna-debug-log\">";
        //var_dump($this->controller->action_form->getArray());
        self::dumpArray($config->config);
        echo "</div> \n";
        echo '</div>';
    }

    function smartyDebug()
    {
        $c =& Ethna_Controller::getInstance();
        $debug_tpl = $c->getDirectory('template') . "/smarty_debug.tpl";

        if (!file_exists($debug_tpl)) {
            Ethna::raiseWarning(sprintf("Smarty debug template not found, please set %s.", $debug_tpl), E_USER_WARNING);
            return null;
        }

        require_once SMARTY_SYSPLUGINS_DIR . 'smarty_internal_debug.php';

        // get template directory
        $r = $c->getRenderer();
        $smarty = $r->engine;

        $vars = Smarty_Internal_Debug::get_debug_vars($smarty);

        //$smarty_original_debugging = $smarty->debugging;
        //$smarty_original_debugtpl = $smarty->debug_tpl;

        //$smarty->debugging = true;
        //$smarty->debug_tpl = $debug_tpl;
        //$smarty->assign('_smarty_debug_output', 'html');

        echo '<div class="ethna-debug" id="ethna-debug-smartydebugwindow">';
        echo '<div class="ethna-debug-title">SmartyDebug</div>';

        echo '<div class="ethna-debug-subtitle">Smarty template vars</div>';
        echo "<div class=\"ethna-debug-log\">";
        foreach ($vars->tpl_vars as $k => $v) {
            echo "$k<br />";
            self::dumpArray($v->value);
        }
        echo "</div> \n";

        echo '<div class="ethna-debug-subtitle">Smarty config vars</div>';
        echo "<div class=\"ethna-debug-log\">";
        foreach ($vars->config_vars as $k => $v) {
            echo "$k<br />";
            self::dumpArray($v->value);
        }
        echo "</div> \n";

        echo "</div> \n";
        echo '</div>';

        //$smarty->debugging = $smarty_original_debugging;
        //$smarty->debug_tpl = $smarty_original_debugtpl;
    }

    function dumpArray(&$array)
    {
        echo "<table class=\"ethna-debug-table\">";
        if (is_scalar($array)) {
            echo "<tr>\n";
            echo "<th>Scalar</th>";
            echo "<td>{$array}</td>";
            echo "</tr>\n";
        }
        elseif (is_object($array)) {
            echo "<tr>\n";
            echo "<th>Object</th>";
            echo "<td>" . get_class($array) . "</td>";
            echo "</tr>\n";
        }
        else foreach ($array as $k => $v) {
            echo "<tr>\n";
            echo "<th>{$k}</th>";
            if (is_array($v)) {
                echo "<td>";
                self::dumpArray($v);
                echo "</td>";
            }
            else {
                if (is_bool($v)) {
                    echo "<td>" . ($v ? '<span style="color: #090;">true</span>' : '<span style="color: #900;">false</span>')  . "</td>";
                }
                else if ($k === 'type' || $k === 'form_type') {
                    echo "<td>";
                    if ($v === null) {
                        echo "Undefined";
                    }
                    else {
                        $key = $k . "_mapping";
                        $ar = $this->$key;
                        echo $ar[$v];
                    }

                    echo "</td>";
                }
                else {
                    echo "<td>{$v}</td>";
                }
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }

}
?>
