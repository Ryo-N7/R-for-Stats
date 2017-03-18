<!DOCTYPE html>
<html  dir="ltr" lang="en" xml:lang="en">
<head>
    <title>Statistics: R notes exercises lecture 8</title>
    <link rel="shortcut icon" href="https://moodle.ucl.ac.uk/theme/image.php/ucl/theme/1481616846/favicon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="moodle, Statistics: R notes exercises lecture 8" />
<link rel="stylesheet" type="text/css" href="https://moodle.ucl.ac.uk/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.css" /><script id="firstthemesheet" type="text/css">/** Required in order to fix style inclusion problems in IE with YUI **/</script><link rel="stylesheet" type="text/css" href="https://moodle.ucl.ac.uk/theme/styles.php/ucl/1481616846/all" />
<script type="text/javascript">
//<![CDATA[
var M = {}; M.yui = {};
M.pageloadstarttime = new Date();
M.cfg = {"wwwroot":"https:\/\/moodle.ucl.ac.uk","sesskey":"IpcRHcXzJI","loadingicon":"https:\/\/moodle.ucl.ac.uk\/theme\/image.php\/ucl\/core\/1481616846\/i\/loading_small","themerev":"1481616846","slasharguments":1,"theme":"ucl","jsrev":"1481616846","admin":"admin","svgicons":true};var yui1ConfigFn = function(me) {if(/-skin|reset|fonts|grids|base/.test(me.name)){me.type='css';me.path=me.path.replace(/\.js/,'.css');me.path=me.path.replace(/\/yui2-skin/,'/assets/skins/sam/yui2-skin')}};
var yui2ConfigFn = function(me) {var parts=me.name.replace(/^moodle-/,'').split('-'),component=parts.shift(),module=parts[0],min='-min';if(/-(skin|core)$/.test(me.name)){parts.pop();me.type='css';min=''};if(module){var filename=parts.join('-');me.path=component+'/'+module+'/'+filename+min+'.'+me.type}else me.path=component+'/'+component+'.'+me.type};
YUI_config = {"debug":false,"base":"https:\/\/moodle.ucl.ac.uk\/lib\/yuilib\/3.17.2\/","comboBase":"https:\/\/moodle.ucl.ac.uk\/theme\/yui_combo.php?","combine":true,"filter":null,"insertBefore":"firstthemesheet","groups":{"yui2":{"base":"https:\/\/moodle.ucl.ac.uk\/lib\/yuilib\/2in3\/2.9.0\/build\/","comboBase":"https:\/\/moodle.ucl.ac.uk\/theme\/yui_combo.php?","combine":true,"ext":false,"root":"2in3\/2.9.0\/build\/","patterns":{"yui2-":{"group":"yui2","configFn":yui1ConfigFn}}},"moodle":{"name":"moodle","base":"https:\/\/moodle.ucl.ac.uk\/theme\/yui_combo.php?m\/1481616846\/","combine":true,"comboBase":"https:\/\/moodle.ucl.ac.uk\/theme\/yui_combo.php?","ext":false,"root":"m\/1481616846\/","patterns":{"moodle-":{"group":"moodle","configFn":yui2ConfigFn}},"filter":null,"modules":{"moodle-core-handlebars":{"condition":{"trigger":"handlebars","when":"after"}},"moodle-core-dragdrop":{"requires":["base","node","io","dom","dd","event-key","event-focus","moodle-core-notification"]},"moodle-core-chooserdialogue":{"requires":["base","panel","moodle-core-notification"]},"moodle-core-maintenancemodetimer":{"requires":["base","node"]},"moodle-core-formautosubmit":{"requires":["base","event-key"]},"moodle-core-tooltip":{"requires":["base","node","io-base","moodle-core-notification-dialogue","json-parse","widget-position","widget-position-align","event-outside","cache-base"]},"moodle-core-actionmenu":{"requires":["base","event","node-event-simulate"]},"moodle-core-blocks":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification"]},"moodle-core-lockscroll":{"requires":["plugin","base-build"]},"moodle-core-formchangechecker":{"requires":["base","event-focus","moodle-core-event"]},"moodle-core-checknet":{"requires":["base-base","moodle-core-notification-alert","io-base"]},"moodle-core-popuphelp":{"requires":["moodle-core-tooltip"]},"moodle-core-languninstallconfirm":{"requires":["base","node","moodle-core-notification-confirm","moodle-core-notification-alert"]},"moodle-core-notification":{"requires":["moodle-core-notification-dialogue","moodle-core-notification-alert","moodle-core-notification-confirm","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-core-notification-dialogue":{"requires":["base","node","panel","escape","event-key","dd-plugin","moodle-core-widget-focusafterclose","moodle-core-lockscroll"]},"moodle-core-notification-alert":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-confirm":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-exception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-ajaxexception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-event":{"requires":["event-custom"]},"moodle-core-dock":{"requires":["base","node","event-custom","event-mouseenter","event-resize","escape","moodle-core-dock-loader","moodle-core-event"]},"moodle-core-dock-loader":{"requires":["escape"]},"moodle-core_availability-form":{"requires":["base","node","event","panel","moodle-core-notification-dialogue","json"]},"moodle-backup-confirmcancel":{"requires":["node","node-event-simulate","moodle-core-notification-confirm"]},"moodle-backup-backupselectall":{"requires":["node","event","node-event-simulate","anim"]},"moodle-calendar-info":{"requires":["base","node","event-mouseenter","event-key","overlay","moodle-calendar-info-skin"]},"moodle-course-modchooser":{"requires":["moodle-core-chooserdialogue","moodle-course-coursebase"]},"moodle-course-formatchooser":{"requires":["base","node","node-event-simulate"]},"moodle-course-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-course-coursebase","moodle-course-util"]},"moodle-course-categoryexpander":{"requires":["node","event-key"]},"moodle-course-util":{"requires":["node"],"use":["moodle-course-util-base"],"submodules":{"moodle-course-util-base":{},"moodle-course-util-section":{"requires":["node","moodle-course-util-base"]},"moodle-course-util-cm":{"requires":["node","moodle-course-util-base"]}}},"moodle-course-toolboxes":{"requires":["node","base","event-key","node","io","moodle-course-coursebase","moodle-course-util"]},"moodle-course-management":{"requires":["base","node","io-base","moodle-core-notification-exception","json-parse","dd-constrain","dd-proxy","dd-drop","dd-delegate","node-event-delegate"]},"moodle-form-dateselector":{"requires":["base","node","overlay","calendar"]},"moodle-form-showadvanced":{"requires":["node","base","selector-css3"]},"moodle-form-shortforms":{"requires":["node","base","selector-css3","moodle-core-event"]},"moodle-form-passwordunmask":{"requires":["node","base"]},"moodle-core_message-deletemessage":{"requires":["node","event"]},"moodle-core_message-messenger":{"requires":["escape","handlebars","io-base","moodle-core-notification-ajaxexception","moodle-core-notification-alert","moodle-core-notification-dialogue","moodle-core-notification-exception"]},"moodle-question-preview":{"requires":["base","dom","event-delegate","event-key","core_question_engine"]},"moodle-question-qbankmanager":{"requires":["node","selector-css3"]},"moodle-question-searchform":{"requires":["base","node"]},"moodle-question-chooser":{"requires":["moodle-core-chooserdialogue"]},"moodle-availability_completion-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_date-form":{"requires":["base","node","event","io","moodle-core_availability-form"]},"moodle-availability_grade-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_group-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_grouping-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_profile-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-qtype_ddimageortext-form":{"requires":["moodle-qtype_ddimageortext-dd","form_filepicker"]},"moodle-qtype_ddimageortext-dd":{"requires":["node","dd","dd-drop","dd-constrain"]},"moodle-qtype_ddmarker-form":{"requires":["moodle-qtype_ddmarker-dd","form_filepicker","graphics","escape"]},"moodle-qtype_ddmarker-dd":{"requires":["node","event-resize","dd","dd-drop","dd-constrain","graphics"]},"moodle-qtype_ddwtos-dd":{"requires":["node","dd","dd-drop","dd-constrain"]},"moodle-mod_assign-history":{"requires":["node","transition"]},"moodle-mod_attendance-groupfilter":{"requires":["base","node"]},"moodle-mod_forum-subscriptiontoggle":{"requires":["base-base","io-base"]},"moodle-mod_hsuforum-livelog":{"requires":["widget"]},"moodle-mod_hsuforum-article":{"requires":["base","node","event","router","core_rating","querystring","moodle-mod_hsuforum-io","moodle-mod_hsuforum-livelog","moodle-core-formchangechecker"]},"moodle-mod_hsuforum-io":{"requires":["base","io-base","io-form","io-upload-iframe","json-parse"]},"moodle-mod_quiz-repaginate":{"requires":["base","event","node","io","moodle-core-notification-dialogue"]},"moodle-mod_quiz-modform":{"requires":["base","node","event"]},"moodle-mod_quiz-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-base","moodle-mod_quiz-util-page","moodle-mod_quiz-util-slot","moodle-course-util"]},"moodle-mod_quiz-quizbase":{"requires":["base","node"]},"moodle-mod_quiz-quizquestionbank":{"requires":["base","event","node","io","io-form","yui-later","moodle-question-qbankmanager","moodle-core-notification-dialogue"]},"moodle-mod_quiz-questionchooser":{"requires":["moodle-core-chooserdialogue","moodle-mod_quiz-util","querystring-parse"]},"moodle-mod_quiz-util":{"requires":["node"],"use":["moodle-mod_quiz-util-base"],"submodules":{"moodle-mod_quiz-util-base":{},"moodle-mod_quiz-util-slot":{"requires":["node","moodle-mod_quiz-util-base"]},"moodle-mod_quiz-util-page":{"requires":["node","moodle-mod_quiz-util-base"]}}},"moodle-mod_quiz-autosave":{"requires":["base","node","event","event-valuechange","node-event-delegate","io-form"]},"moodle-mod_quiz-toolboxes":{"requires":["base","node","event","event-key","io","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-slot","moodle-core-notification-ajaxexception"]},"moodle-mod_quiz-randomquestion":{"requires":["base","event","node","io","moodle-core-notification-dialogue"]},"moodle-mod_scheduler-delselected":{"requires":["base","node","event"]},"moodle-mod_scheduler-studentlist":{"requires":["base","node","event","io"]},"moodle-mod_scheduler-saveseen":{"requires":["base","node","event"]},"moodle-mod_scheduler-limitchoices":{"requires":["base","node","event"]},"moodle-message_airnotifier-toolboxes":{"requires":["base","node","io"]},"moodle-filter_glossary-autolinker":{"requires":["base","node","io-base","json-parse","event-delegate","overlay","moodle-core-event","moodle-core-notification-alert","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-filter_mathjaxloader-loader":{"requires":["moodle-core-event"]},"moodle-editor_atto-editor":{"requires":["node","transition","io","overlay","escape","event","event-simulate","event-custom","node-event-html5","node-event-simulate","yui-throttle","moodle-core-notification-dialogue","moodle-core-notification-confirm","moodle-editor_atto-rangy","handlebars","timers","querystring-stringify"]},"moodle-editor_atto-plugin":{"requires":["node","base","escape","event","event-outside","handlebars","event-custom","timers","moodle-editor_atto-menu"]},"moodle-editor_atto-menu":{"requires":["moodle-core-notification-dialogue","node","event","event-custom"]},"moodle-editor_atto-rangy":{"requires":[]},"moodle-format_grid-gridkeys":{"requires":["event-nav-keys"]},"moodle-report_eventlist-eventfilter":{"requires":["base","event","node","node-event-delegate","datatable","autocomplete","autocomplete-filters"]},"moodle-report_loglive-fetchlogs":{"requires":["base","event","node","io","node-event-delegate"]},"moodle-gradereport_grader-gradereporttable":{"requires":["base","node","event","handlebars","overlay","event-hover"]},"moodle-gradereport_history-userselector":{"requires":["escape","event-delegate","event-key","handlebars","io-base","json-parse","moodle-core-notification-dialogue"]},"moodle-tool_capability-search":{"requires":["base","node"]},"moodle-tool_lp-dragdrop-reorder":{"requires":["moodle-core-dragdrop"]},"moodle-tool_monitor-dropdown":{"requires":["base","event","node"]},"moodle-assignfeedback_editpdf-editor":{"requires":["base","event","node","io","graphics","json","event-move","event-resize","transition","querystring-stringify-simple","moodle-core-notification-dialog","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-atto_accessibilitychecker-button":{"requires":["color-base","moodle-editor_atto-plugin"]},"moodle-atto_accessibilityhelper-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_align-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_bold-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_charmap-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_clear-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_collapse-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_emoticon-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_equation-button":{"requires":["moodle-editor_atto-plugin","moodle-core-event","io","event-valuechange","tabview","array-extras"]},"moodle-atto_helixatto-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_html-button":{"requires":["moodle-editor_atto-plugin","event-valuechange"]},"moodle-atto_htmlplus-beautify":{},"moodle-atto_htmlplus-button":{"requires":["moodle-editor_atto-plugin","moodle-atto_htmlplus-beautify","moodle-atto_htmlplus-codemirror","event-valuechange"]},"moodle-atto_htmlplus-codemirror":{"requires":["moodle-atto_htmlplus-codemirror-skin"]},"moodle-atto_image-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_imagedragdrop-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_indent-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_italic-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_link-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_managefiles-usedfiles":{"requires":["node","escape"]},"moodle-atto_managefiles-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_media-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_noautolink-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_orderedlist-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_rtl-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_strike-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_subscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_superscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_table-button":{"requires":["moodle-editor_atto-plugin","moodle-editor_atto-menu","event","event-valuechange"]},"moodle-atto_title-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_underline-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_undo-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_unorderedlist-button":{"requires":["moodle-editor_atto-plugin"]}}},"gallery":{"name":"gallery","base":"https:\/\/moodle.ucl.ac.uk\/lib\/yuilib\/gallery\/","combine":true,"comboBase":"https:\/\/moodle.ucl.ac.uk\/theme\/yui_combo.php?","ext":false,"root":"gallery\/1481616846\/","patterns":{"gallery-":{"group":"gallery"}}}},"modules":{"core_filepicker":{"name":"core_filepicker","fullpath":"https:\/\/moodle.ucl.ac.uk\/lib\/javascript.php\/1481616846\/repository\/filepicker.js","requires":["base","node","node-event-simulate","json","async-queue","io-base","io-upload-iframe","io-form","yui2-treeview","panel","cookie","datatable","datatable-sort","resize-plugin","dd-plugin","escape","moodle-core_filepicker"]},"core_comment":{"name":"core_comment","fullpath":"https:\/\/moodle.ucl.ac.uk\/lib\/javascript.php\/1481616846\/comment\/comment.js","requires":["base","io-base","node","json","yui2-animation","overlay"]},"mathjax":{"name":"mathjax","fullpath":"https:\/\/cdn.mathjax.org\/mathjax\/2.6-latest\/MathJax.js?delayStartupUntil=configured"}}};
M.yui.loader = {modules: {}};

//]]>
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
    <!-- iOS Homescreen Icons -->
    
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://moodle.ucl.ac.uk/theme/image.php/ucl/theme/1481616846/homeicon/iphone" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://moodle.ucl.ac.uk/theme/image.php/ucl/theme/1481616846/homeicon/ipad" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://moodle.ucl.ac.uk/theme/image.php/ucl/theme/1481616846/homeicon/iphone_retina" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://moodle.ucl.ac.uk/theme/image.php/ucl/theme/1481616846/homeicon/ipad_retina" /></head>

<body  id="page-mod-resource-view" class="format-onetopic  path-mod path-mod-resource gecko dir-ltr lang-en yui-skin-sam yui3-skin-sam moodle-ucl-ac-uk pagelayout-incourse course-11131 context-3799701 cmid-2687979 category-183 three-column ucl-colours-default has-region-side-pre empty-region-side-pre has-region-side-post used-region-side-post has-region-footer-left empty-region-footer-left has-region-footer-middle empty-region-footer-middle has-region-footer-right empty-region-footer-right side-post-only">

<div class="skiplinks"><a class="skip" href="#maincontent">Skip to main content</a></div>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.js&amp;rollup/1481616846/mcore-min.js"></script><script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/core/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/cslider_1.0.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/custom_1.0.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/alert_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/carousel_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/collapse_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/modal_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/scrollspy_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/tab_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/tooltip_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/bootstrap_plugins/transition_2.3.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/modernizr_2.6.2.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/jquery.php/theme_ucl/ba-floatingscrollbar.js"></script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/lib/javascript.php/1481616846/lib/javascript-static.js"></script>
<script type="text/javascript">
//<![CDATA[
document.body.className += ' jsenabled';
//]]>
</script>




	<header id="page-header" class="clearfix">

    <div class="container-fluid">
    
    <div class="row-fluid-small">
    	<div class="span12">
    		<h1 id="title">PSYCGR01: Statistics</h1>
    		<div class="logo-background-small">
        		        		<div class="logo-small">
        			<a class="logo-link-small" href="http://www.ucl.ac.uk"></a>
        		</div>
        	</div>
    	</div>
    </div>
    
    <div class="row-fluid">
    <!-- HEADER: LOGO AREA -->
       
        <div class="span9">
            <h1 id="title">PSYCGR01: Statistics</h1>
        </div> <!-- class="span9" -->
        <div class="span3">
        	<div class="logo-background">
        	        		<div class="logo">
        			<a class="logo-link" href="http://www.ucl.ac.uk"></a>
        		</div>
        	</div>
        </div>

            </div>
</header>

<header role="banner" class="navbar navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav"><li class="dropdown"><a href="#cm_submenu_1" class="dropdown-toggle" data-toggle="dropdown" title="Staff Help">Staff Help<b class="caret"></b></a><ul class="dropdown-menu"><li><a title="Login Problems?" href="https://wiki.ucl.ac.uk/display/MoodleResourceCentre/Moodle+Staff+FAQs#MoodleStaffFAQs-HowdoIlogin%3F "target=\"_blank">Login Problems?</a></li><li><a title="Moodle Resource Centre" href="https://wiki.ucl.ac.uk/display/MoodleResourceCentre/Guides+to+using+Moodle+for+staff" target=\"_blank "target=\"_blank">Moodle Resource Centre</a></li><li><a title="About Moodle at UCL" href="http://www.ucl.ac.uk/isd/staff/e-learning/core-tools/moodle/about "target=\"_blank">About Moodle at UCL</a></li><li><a title="FAQs" href="https://wiki.ucl.ac.uk/display/MoodleResourceCentre/Moodle+Staff+FAQs "target=\"_blank">FAQs</a></li><li><a title="Request a Moodle Course" href="http://www.ucl.ac.uk/isd-extra/staff/e-learning/tools/moodle/newcourse.php "target=\"_blank">Request a Moodle Course</a></li><li><a title="Moodle Exam Notification" href="http://www.ucl.ac.uk/isd-extra/staff/e-learning/tools/moodle/exam.php "target=\"_blank">Moodle Exam Notification</a></li><li><a title="Moodle Training" href="https://www.ucl.ac.uk/isd/services/learning-teaching/elearning-staff/training "target=\"_blank">Moodle Training</a></li><li><a title="Contact Moodle Support" href="http://www.ucl.ac.uk/isd/services/learning-teaching/elearning-staff/about/support "target=\"_blank">Contact Moodle Support</a></li><li><a title="UCL Moodle User Group" href="https://moodle.ucl.ac.uk/course/view.php?id=46">UCL Moodle User Group</a></li></ul><li class="dropdown"><a href="#cm_submenu_2" class="dropdown-toggle" data-toggle="dropdown" title="Student Help">Student Help<b class="caret"></b></a><ul class="dropdown-menu"><li><a title="Login Problems?" href="https://wiki.ucl.ac.uk/display/ELearningStudentSupport/Moodle+FAQs#MoodleFAQs-Whycan%27tIlogontoUCLMoodlewithmyUCLusernameandpassword%3F "target=\"_blank">Login Problems?</a></li><li><a title="Moodle Quick Start Guide" href="https://wiki.ucl.ac.uk/display/ELearningStudentSupport/Moodle+Quick+Start+Guide+for+Students "target=\"_blank">Moodle Quick Start Guide</a></li><li><a title="Moodle for e-Assessment" href="https://wiki.ucl.ac.uk/x/igWmAQ "target=\"_blank">Moodle for e-Assessment</a></li><li><a title="Learning with Technology" href="https://moodle.ucl.ac.uk/course/view.php?id=34285">Learning with Technology</a></li><li><a title="Plagiarism and Academic Writing" href="https://moodle.ucl.ac.uk/course/view.php?id=12731">Plagiarism and Academic Writing</a></li><li><a title="Subject area Study Skills" href="https://moodle.ucl.ac.uk/course/category.php?id=70">Subject area Study Skills</a></li><li><a title="IT training for Students" href="http://www.ucl.ac.uk/isd/students/training "target=\"_blank">IT training for Students</a></li><li><a title="FAQs" href="https://wiki.ucl.ac.uk/display/ELearningStudentSupport/Moodle+FAQs "target=\"_blank">FAQs</a></li><li><a title="Turnitin Help" href="https://wiki.ucl.ac.uk/display/ELearningStudentSupport/Turnitin "target=\"_blank">Turnitin Help</a></li><li><a title="More student links" href="http://www.ucl.ac.uk/students "target=\"_blank">More student links</a></li></ul><li class="dropdown"><a href="#cm_submenu_3" class="dropdown-toggle" data-toggle="dropdown" title="Services">Services<b class="caret"></b></a><ul class="dropdown-menu"><li><a title="Moodle Snapshot" href="https://moodle-snapshot.ucl.ac.uk/ "target=\"_blank">Moodle Snapshot</a></li><li><a title="Lynda" href="http://www.ucl.ac.uk/lynda "target=\"_blank">Lynda</a></li><li><a title="Box of Broadcasts" href="http://bobnational.net/ "target=\"_blank">Box of Broadcasts</a></li><li><a title="Portico" href="http://www.ucl.ac.uk/portico "target=\"_blank">Portico</a></li><li><a title="Common Timetable" href="http://www.ucl.ac.uk/timetable "target=\"_blank">Common Timetable</a></li><li><a title="Library" href="http://www.ucl.ac.uk/library "target=\"_blank">Library</a></li><li><a title="MyAccount" href="https://myaccount.ucl.ac.uk/ "target=\"_blank">MyAccount</a></li><li><a title="Live@UCL Email" href="http://outlook.com/live.ucl.ac.uk "target=\"_blank">Live@UCL Email</a></li><li><a title="MyPortfolio" href="https://myportfolio.ucl.ac.uk "target=\"_blank">MyPortfolio</a></li></ul><li class="dropdown"><a href="https://moodle.ucl.ac.uk/my/index.php" class="dropdown-toggle" data-toggle="dropdown" title="My courses">My courses<b class="caret"></b></a><ul class="dropdown-menu"><li><a title="Digital Skills Development" href="https://moodle.ucl.ac.uk/course/view.php?id=21989">ISD Digital Skills Development</a></li><li><a title="TMSPSYSIOB011_16/17" href="https://moodle.ucl.ac.uk/course/view.php?id=39551">MSc Industrial/Organisational and Business Psychology 16/17</a></li><li><a title="MSIN3101/G101/M101" href="https://moodle.ucl.ac.uk/course/view.php?id=23001">MSIN3101/G101/M101: Strategic Project Management</a></li><li><a title="MSING024" href="https://moodle.ucl.ac.uk/course/view.php?id=19038">MSING024: Influence and Negotiations</a></li><li><a title="PALS Career Talks" href="https://moodle.ucl.ac.uk/course/view.php?id=28119">PALS Career Talks</a></li><li><a title="PSYC3109" href="https://moodle.ucl.ac.uk/course/view.php?id=22113">PSYC3109 The Social Psychology of Risk</a></li><li><a title="PSYCGB01_16/17" href="https://moodle.ucl.ac.uk/course/view.php?id=34393">PSYCGB01: Consulting Psychology</a></li><li><a title="PSYCGB02_16/17" href="https://moodle.ucl.ac.uk/course/view.php?id=34397">PSYCGB02: Talent Management</a></li><li><a title="PSYCGB03_16/17" href="https://moodle.ucl.ac.uk/course/view.php?id=34407">PSYCGB03: Business Psychology Seminars</a></li><li><a title="PSYCGB04_16/17" href="https://moodle.ucl.ac.uk/course/view.php?id=34391">PSYCGB04: Consumer Behaviour</a></li><li><a title="Statistics" href="https://moodle.ucl.ac.uk/course/view.php?id=11131">PSYCGR01: Statistics</a></li></ul></ul>                <ul class="nav pull-right">
                    <li></li>
                    <li class="navbar-text"><div class="usermenu"><div id="action-menu-0" class="moodle-actionmenu nowrap-items" data-enhance="moodle-core-actionmenu"><ul id="action-menu-0-menubar" class="menubar" role="menubar"><li role="presentation"><a class="toggle-display textmenu" title="" id="action-menu-toggle-0" role="menuitem" href="#"><span class="userbutton"><span class="usertext">Ryo Nakagawara</span><span class="avatars"><span class="avatar current"><img src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/u/f2" alt="Picture of Ryo Nakagawara" title="Picture of Ryo Nakagawara" class="userpicture defaultuserpic" width="35" height="35" role="presentation" /></span></span></span><b class="caret"></b></a></li></ul><ul id="action-menu-0-menu" class="menu  align-tr-br" data-rel="menu-content" aria-labelledby="action-menu-toggle-0" role="menu" data-align="tr-br"><li role="presentation"><a class="icon menu-action" role="menuitem" data-title="mymoodle,admin" href="https://moodle.ucl.ac.uk/my/" aria-labelledby="actionmenuaction-1"><img class="iconsmall" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/course" /><span class="menu-action-text" id="actionmenuaction-1">My home</span></a></li><li role="presentation"><span class="filler">&nbsp;</span></li><li role="presentation"><a class="icon menu-action" role="menuitem" data-title="profile,moodle" href="https://moodle.ucl.ac.uk/user/profile.php?id=495403" aria-labelledby="actionmenuaction-2"><img class="iconsmall" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/user" /><span class="menu-action-text" id="actionmenuaction-2">Profile</span></a></li><li role="presentation"><a class="icon menu-action" role="menuitem" data-title="preferences,moodle" href="https://moodle.ucl.ac.uk/user/preferences.php" aria-labelledby="actionmenuaction-3"><img class="iconsmall" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/t/preferences" /><span class="menu-action-text" id="actionmenuaction-3">Preferences</span></a></li><li role="presentation"><span class="filler">&nbsp;</span></li><li role="presentation"><a class="icon menu-action" role="menuitem" data-title="logout,moodle" href="https://moodle.ucl.ac.uk/login/logout.php?sesskey=IpcRHcXzJI" aria-labelledby="actionmenuaction-4"><img class="iconsmall" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/a/logout" /><span class="menu-action-text" id="actionmenuaction-4">Log out</span></a></li></ul></div></div></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Start Main Regions -->
<div id="page3" class="container-fluid">
	<div id="page-navbar" class="clearfix">
		<div class="breadcrumb-nav"><span class="accesshide">Page path</span><ul class="breadcrumb"><li><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="https://moodle.ucl.ac.uk/my/"><span itemprop="title">My home</span></a></span> <span class="divider"> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> </span></li><li><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" title="PSYCGR01: Statistics" href="https://moodle.ucl.ac.uk/course/view.php?id=11131"><span itemprop="title">Statistics</span></a></span> <span class="divider"> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> </span></li><li><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=8"><span itemprop="title">Repeated measures ANOVA</span></a></span> <span class="divider"> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> </span></li><li><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" title="File" href="https://moodle.ucl.ac.uk/mod/resource/view.php?id=2687979"><span itemprop="title">R notes exercises lecture 8</span></a></span></li></ul></div>
		<nav class="breadcrumb-button"></nav>
	</div>
    <div id="page-content" class="row-fluid">
        <div id="region-bs-main-and-pre" class="span9">
            <div class="row-fluid">
            	<section id="region-main" class="span8 pull-right">
                	<span class="notifications" id="user-notifications"></span><div role="main"><span id="maincontent"></span><h2>R notes exercises lecture 8</h2><div class="resourcecontent resourcegeneral">
  <iframe id="resourceobject" src="https://moodle.ucl.ac.uk/pluginfile.php/3799701/mod_resource/content/1/exercises8.html">
    Click <a href="https://moodle.ucl.ac.uk/pluginfile.php/3799701/mod_resource/content/1/exercises8.html" >exercises8.html</a> link to view the file.
  </iframe>
</div><div id="resourceintro" class="box mod_introbox"><p class="resourcedetails">775.8KB HTML document</p></div></div>                </section>            
                <aside id="block-region-side-pre" class="span4 desktop-first-column block-region" data-blockregion="side-pre" data-droptarget="1"></aside>            </div>
        </div>
        <aside id="block-region-side-post" class="span3 block-region" data-blockregion="side-post" data-droptarget="1"><a class="skip skip-block" id="fsb-1" href="#sb-1">Skip Navigation</a><div id="inst321033" class="block_navigation  block" role="navigation" data-block="navigation" data-instanceid="321033" aria-labelledby="instance-321033-header"><div class="header"><div class="title"><div class="block_action"></div><h2 id="instance-321033-header">Navigation</h2></div></div><div class="content"><ul class="block_tree list" role="tree" data-ajax-loader="block_navigation/nav_loader"><li class="type_unknown depth_1 contains_branch" aria-labelledby="label_1_1"><p class="tree_item branch canexpand navigation_node" role="treeitem" aria-expanded="true" aria-owns="random585bf111e2e846_group" data-collapsible="false"><a tabindex="-1" id="label_1_1" href="https://moodle.ucl.ac.uk/my/">My home</a></p><ul id="random585bf111e2e846_group" role="group"><li class="type_setting depth_2 item_with_icon" aria-labelledby="label_2_2"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_2_2" href="https://moodle.ucl.ac.uk/?redirect=0"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Site home</span></a></p></li><li class="type_course depth_2 contains_branch" aria-labelledby="label_2_3"><p class="tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random585bf111e2e848_group"><span tabindex="-1" id="label_2_3" title="UCL Moodle">UCLMoodle</span></p><ul id="random585bf111e2e848_group" role="group" aria-hidden="true"><li class="type_unknown depth_3 item_with_icon" aria-labelledby="label_3_5"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_5" href="https://moodle.ucl.ac.uk/blog/index.php"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Site blogs</span></a></p></li><li class="type_custom depth_3 item_with_icon" aria-labelledby="label_3_6"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_6" href="https://moodle.ucl.ac.uk/badges/view.php?type=1"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Site badges</span></a></p></li><li class="type_setting depth_3 item_with_icon" aria-labelledby="label_3_7"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_7" href="https://moodle.ucl.ac.uk/tag/search.php"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Tags</span></a></p></li><li class="type_custom depth_3 item_with_icon" aria-labelledby="label_3_8"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_8" href="https://moodle.ucl.ac.uk/calendar/view.php?view=month"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Calendar</span></a></p></li><li class="type_activity depth_3 item_with_icon" aria-labelledby="label_3_9"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_9" title="Forum" href="https://moodle.ucl.ac.uk/mod/forum/view.php?id=1"><img class="smallicon navicon" alt="Forum" title="Forum" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/forum/1481616846/icon" /><span class="item-content-wrap">News</span></a></p></li></ul></li><li class="type_system depth_2 contains_branch" aria-labelledby="label_2_10"><p class="tree_item branch" role="treeitem" aria-expanded="true" aria-owns="random585bf111e2e8414_group"><span tabindex="-1" id="label_2_10">Current course</span></p><ul id="random585bf111e2e8414_group" role="group"><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_11"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random585bf111e2e8415_group"><a tabindex="-1" id="label_3_11" title="PSYCGR01: Statistics" href="https://moodle.ucl.ac.uk/course/view.php?id=11131">Statistics</a></p><ul id="random585bf111e2e8415_group" role="group"><li class="type_unknown depth_4 contains_branch" aria-labelledby="label_4_12"><p class="tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random585bf111e2e8416_group"><a tabindex="-1" id="label_4_12" href="https://moodle.ucl.ac.uk/user/index.php?id=11131">Participants</a></p><ul id="random585bf111e2e8416_group" role="group" aria-hidden="true"><li class="type_setting depth_5 item_with_icon" aria-labelledby="label_5_13"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_5_13" href="https://moodle.ucl.ac.uk/blog/index.php?courseid=11131"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Course blogs</span></a></p></li><li class="type_user depth_5 item_with_icon" aria-labelledby="label_5_14"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_5_14" href="https://moodle.ucl.ac.uk/user/view.php?id=495403&amp;course=11131"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Ryo Nakagawara</span></a></p></li></ul></li><li class="type_unknown depth_4 contains_branch" aria-labelledby="label_4_15"><p class="tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random585bf111e2e8419_group"><span tabindex="-1" id="label_4_15">Badges</span></p><ul id="random585bf111e2e8419_group" role="group" aria-hidden="true"><li class="type_setting depth_5 item_with_icon" aria-labelledby="label_5_16"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_5_16" href="https://moodle.ucl.ac.uk/badges/view.php?type=2&amp;id=11131"><img class="smallicon navicon" alt="Course badges" title="Course badges" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/badge" /><span class="item-content-wrap">Course badges</span></a></p></li></ul></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_17"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136457"><a tabindex="-1" id="label_4_17" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=0"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">General Information</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_18"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136459"><a tabindex="-1" id="label_4_18" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=1"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Introduction</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_19"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136461"><a tabindex="-1" id="label_4_19" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=2"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Statistical inference</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_20"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136463"><a tabindex="-1" id="label_4_20" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=3"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Regression</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_21"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136465"><a tabindex="-1" id="label_4_21" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=4"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">GLM assumptions and diagnostics</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_22"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136479"><a tabindex="-1" id="label_4_22" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=5"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Moderation and mediation</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_23"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136467"><a tabindex="-1" id="label_4_23" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=6"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Contrast coding (ANOVA)</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_24"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136469"><a tabindex="-1" id="label_4_24" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=7"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Further topics in ANOVA and ANCOVA</span></a></p></li><li class="type_structure depth_4 contains_branch" aria-labelledby="label_4_25"><p class="tree_item branch" role="treeitem" aria-expanded="true" aria-owns="random585bf111e2e8421_group"><a tabindex="-1" id="label_4_25" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=8">Repeated measures ANOVA</a></p><ul id="random585bf111e2e8421_group" role="group"><li class="type_activity depth_5 item_with_icon current_branch" aria-labelledby="label_5_34"><p class="tree_item hasicon active_tree_node" role="treeitem"><a tabindex="-1" id="label_5_34" title="File" href="https://moodle.ucl.ac.uk/mod/resource/view.php?id=2687979"><img class="smallicon navicon" alt="File" title="File" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/f/html-24" /><span class="item-content-wrap">R notes exercises lecture 8</span></a></p></li></ul></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_39"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136475"><a tabindex="-1" id="label_4_39" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=9"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Introduction to mixed effects and multilevel models</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_40"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136481"><a tabindex="-1" id="label_4_40" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=10"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Assessment</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_41"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136477"><a tabindex="-1" id="label_4_41" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=11"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Introduction to Bayesian hypothesis testing</span></a></p></li><li class="type_structure depth_4 item_with_icon" aria-labelledby="label_4_42"><p class="tree_item hasicon" role="treeitem" id="expandable_branch_30_136473"><a tabindex="-1" id="label_4_42" href="https://moodle.ucl.ac.uk/course/view.php?id=11131&amp;section=12"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/navigationitem" /><span class="item-content-wrap">Logistic regression</span></a></p></li></ul></li></ul></li><li class="type_system depth_2 contains_branch" aria-labelledby="label_2_43"><p class="tree_item branch" role="treeitem" id="expandable_branch_0_mycourses" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_0_mycourses" data-node-key="mycourses" data-node-type="0"><span tabindex="-1" id="label_2_43">My courses</span></p></li></ul></li></ul></div></div><span class="skip-block-to" id="sb-1"></span><a class="skip skip-block" id="fsb-2" href="#sb-2">Skip MyFeedback</a><div id="inst489389" class="block_html  block" role="complementary" data-block="html" data-instanceid="489389" aria-labelledby="instance-489389-header"><div class="header"><div class="title"><div class="block_action"></div><h2 id="instance-489389-header">MyFeedback</h2></div></div><div class="content"><div class="no-overflow"><p>The MyFeedback dashboard allows students and their personal tutors to view feedback and grades across modules in one place. <br />Go to <a href="https://moodle.ucl.ac.uk/report/myfeedback/">MyFeedback</a> <a href="https://wiki.ucl.ac.uk/display/ELearningStudentSupport/MyFeedback+for+students" target="_blank"> <img src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1453386056/help" alt="Get help using My feedback" style="vertical-align: text-top; margin: 0 .5em;" class="img-responsive" width="16" height="16" /> </a></p></div></div></div><span class="skip-block-to" id="sb-2"></span><a class="skip skip-block" id="fsb-3" href="#sb-3">Skip Settings</a><div id="inst321036" class="block_settings  block" role="navigation" data-block="settings" data-instanceid="321036" aria-labelledby="instance-321036-header"><div class="header"><div class="title"><div class="block_action"></div><h2 id="instance-321036-header">Settings</h2></div></div><div class="content"><div id="settingsnav" class="box block_tree_box"><ul class="block_tree list" role="tree" data-ajax-loader="block_navigation/site_admin_loader"><li class="type_course depth_1 contains_branch" tabindex="-1" aria-labelledby="label_1_1"><p class="tree_item root_node tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random585bf111e2e8423_group"><span tabindex="0">Course administration</span></p><ul id="random585bf111e2e8423_group" role="group" aria-hidden="true"><li class="type_setting depth_2 item_with_icon" tabindex="-1" aria-labelledby="label_2_1"><p class="tree_item hasicon tree_item leaf" role="treeitem"><a href="https://moodle.ucl.ac.uk/grade/report/index.php?id=11131"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/grades" />Grades</a></p></li>
<li class="type_setting depth_2 item_with_icon" tabindex="-1" aria-labelledby="label_2_2"><p class="tree_item hasicon tree_item leaf" role="treeitem"><a href="https://moodle.ucl.ac.uk/admin/tool/lp/coursecompetencies.php?courseid=11131"><img class="smallicon navicon" alt="" src="https://moodle.ucl.ac.uk/theme/image.php/ucl/core/1481616846/i/competencies" />Competencies</a></p></li></ul></li></ul></div></div></div><span class="skip-block-to" id="sb-3"></span></aside>    </div>
    
    <!-- End Main Regions -->

	

<p class="helplink"></p>
<footer id="page-footer" class="wrapper container-fluid clearfix">

		
	<article class="block-myucl">
		<h2>Facilities</h2>
		<ul>
			<li><a href="http://www.ucl.ac.uk/departments/faculties">Faculties and departments</a></li>
			<li><a href="http://www.ucl.ac.uk/library/">Library</a></li>
			<li><a href="http://www.ucl.ac.uk/museums">Museums and Collections</a></li>
			<li><a href="http://www.thebloomsbury.com/">UCL Bloomsbury Theatre</a></li>
			<li><a href="http://www.ucl.ac.uk/maps">Maps and buildings</a></li>
		</ul>
	</article>

	<article class="block-finditfast1">
		<h2>Locations</h2>
		<ul>
			<li><a href="http://www.ucl.ac.uk/london">UCL and London</a></li>
			<li><a href="http://www.ucl.ac.uk/australia#">UCL Australia</a></li>
			<li><a href="http://www.ucl.ac.uk/qatar">UCL Qatar</a></li>
		</ul>
	</article>

	<article class="block-finditfast2">
		<h2>Connect with us</h2>
		<ul>
			<li><a href="http://www.ucl.ac.uk/alumni">Alumni</a></li>
			<li><a href="http://www.ucl.ac.uk/enterprise">Businesses</a></li>
			<li><a href="http://www.ucl.ac.uk/media">Media Relations</a></li>
			<li><a href="http://www.ucl.ac.uk/hr/jobs/">Jobs</a></li>
			<li><a href="http://www.ucl.ac.uk/makeyourmark">Support us</a></li>
		</ul>

	</article>

	<hr>

	<p>University College London,&nbsp;Gower Street,&nbsp;London,&nbsp;WC1E 6BT&nbsp;Tel:&nbsp;+44&nbsp;(0)&nbsp;20 7679 2000</p>

	<p id="footer-links">Copyright &copy; 2013 UCL <a href="http://www.ucl.ac.uk/disclaimer">Disclaimer</a> | <a href="http://www.ucl.ac.uk/foi">Freedom of Information</a> | <a href="http://www.ucl.ac.uk/accessibility">Accessibility</a> | <a href="http://www.ucl.ac.uk/privacy">Privacy</a> | <a href="http://www.ucl.ac.uk/cookies">Cookies</a> | <a href="http://www.ucl.ac.uk/contact-list">Contact Us</a></p>

	<div class="usepolicy"><a href="//moodle.ucl.ac.uk/pluginfile.php/1/theme_ucl/usepolicy/1481616846/UCL_Moodle_usage_policy.html" target="_blank">UCL Moodle usage policy and guidelines</a></div>
	<div class="moodlepower">Powered by: Moodle 3.1</div>

<!--start hack - cceaean - 08/11/2016 -  Display server name-->
e<!--end hack - cceaean - 08/11/2016 -  Display server name-->
	
</footer>
    <script type="text/javascript">
//<![CDATA[
var require = {
    baseUrl : 'https://moodle.ucl.ac.uk/lib/requirejs.php/1481616846/',
    // We only support AMD modules with an explicit define() statement.
    enforceDefine: true,
    skipDataMain: true,
    waitSeconds : 0,

    paths: {
        jquery: 'https://moodle.ucl.ac.uk/lib/javascript.php/1481616846/lib/jquery/jquery-1.12.1.min',
        jqueryui: 'https://moodle.ucl.ac.uk/lib/javascript.php/1481616846/lib/jquery/ui-1.11.4/jquery-ui.min',
        jqueryprivate: 'https://moodle.ucl.ac.uk/lib/javascript.php/1481616846/lib/requirejs/jquery-private'
    },

    // Custom jquery config map.
    map: {
      // '*' means all modules will get 'jqueryprivate'
      // for their 'jquery' dependency.
      '*': { jquery: 'jqueryprivate' },

      // 'jquery-private' wants the real jQuery module
      // though. If this line was not here, there would
      // be an unresolvable cyclic dependency.
      jqueryprivate: { jquery: 'jquery' }
    }
};

//]]>
</script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/lib/javascript.php/1481616846/lib/requirejs/require.min.js"></script>
<script type="text/javascript">
//<![CDATA[
require(['core/first'], function() {
;
require(["block_navigation/navblock"], function(amd) { amd.init("321033"); });;
require(["block_settings/settingsblock"], function(amd) { amd.init("321036", null); });;
require(["core/log"], function(amd) { amd.setConfig({"level":"warn"}); });
});
//]]>
</script>
<script type="text/javascript" src="https://moodle.ucl.ac.uk/theme/javascript.php/ucl/1481616846/footer"></script>
<script type="text/javascript">
//<![CDATA[
M.str = {"moodle":{"lastmodified":"Last modified","name":"Name","error":"Error","info":"Information","yes":"Yes","no":"No","viewallcourses":"View all courses","ok":"OK","morehelp":"More help","loadinghelp":"Loading...","cancel":"Cancel","confirm":"Confirm","areyousure":"Are you sure?","closebuttontitle":"Close","unknownerror":"Unknown error"},"repository":{"type":"Type","size":"Size","invalidjson":"Invalid JSON string","nofilesattached":"No files attached","filepicker":"File picker","logout":"Logout","nofilesavailable":"No files available","norepositoriesavailable":"Sorry, none of your current repositories can return files in the required format.","fileexistsdialogheader":"File exists","fileexistsdialog_editor":"A file with that name has already been attached to the text you are editing.","fileexistsdialog_filemanager":"A file with that name has already been attached","renameto":"Rename to \"{$a}\"","referencesexist":"There are {$a} alias\/shortcut files that use this file as their source","select":"Select"},"admin":{"confirmdeletecomments":"You are about to delete comments, are you sure?","confirmation":"Confirmation"}};
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
(function() {M.util.load_flowplayer();
setTimeout("fix_column_widths()", 20);
 M.util.js_pending('random585bf111e2e841'); Y.on('domready', function() { M.util.init_maximised_embed(Y, "resourceobject");  M.util.js_complete('random585bf111e2e841'); });
function legacy_activity_onclick_handler_1(e) { e.halt(); window.open('https://moodle.ucl.ac.uk/mod/resource/view.php?id=404823&redirect=1', '', 'width=620,height=450,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false; };
function legacy_activity_onclick_handler_2(e) { e.halt(); window.open('https://moodle.ucl.ac.uk/mod/url/view.php?id=1090131&redirect=1'); return false; };
function legacy_activity_onclick_handler_3(e) { e.halt(); window.open('https://moodle.ucl.ac.uk/mod/resource/view.php?id=404825&redirect=1', '', 'width=620,height=450,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false; };
function legacy_activity_onclick_handler_4(e) { e.halt(); window.open('https://moodle.ucl.ac.uk/mod/resource/view.php?id=717624&redirect=1', '', 'width=800,height=600,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false; };
Y.use("moodle-filter_glossary-autolinker",function() {M.filter_glossary.init_filter_autolinking({"courseid":0});
});
Y.use("moodle-filter_mathjaxloader-loader",function() {M.filter_mathjaxloader.configure({"mathjaxconfig":"MathJax.Hub.Config({\r\n    config: [\"Accessible.js\", \"Safe.js\"],\r\n    errorSettings: { message: [\"!\"] },\r\n    skipStartupTypeset: true,\r\n    messageStyle: \"none\"\r\n});\r\n","lang":"en"});
});
M.util.help_popups.setup(Y);
Y.use("moodle-core-popuphelp",function() {M.core.init_popuphelp();
});
M.util.init_skiplink(Y);
Y.use("moodle-core-actionmenu",function() {M.core.actionmenu.init();
});
M.util.init_block_hider(Y, {"id":"inst321033","title":"Navigation","preference":"block321033hidden","tooltipVisible":"Hide Navigation block","tooltipHidden":"Show Navigation block"});
M.util.init_block_hider(Y, {"id":"inst489389","title":"MyFeedback","preference":"block489389hidden","tooltipVisible":"Hide MyFeedback block","tooltipHidden":"Show MyFeedback block"});
M.util.init_block_hider(Y, {"id":"inst321036","title":"Settings","preference":"block321036hidden","tooltipVisible":"Hide Settings block","tooltipHidden":"Show Settings block"});
 M.util.js_pending('random585bf111e2e8431'); Y.on('domready', function() { M.util.js_complete("init");  M.util.js_complete('random585bf111e2e8431'); });
})();
//]]>
</script>

</div>

<!-- Start Google Analytics -->
	<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');


	ga('create', 'UA-4551567-2', 
	{
		'cookieDomain': 'moodle.ucl.ac.uk',
		'cookieExpires': '10800'
	});
			ga('send', 'pageview' );

	</script><!-- End Google Analytics -->

<script type="text/javascript">
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>
<a href="#top" class="back-to-top" title="Back to top">&#9650</a>
</body>
</html>
