<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Dashboard I Admin Panel</title>
    
    <link rel="stylesheet" href="<?=base_url()?>css/layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>css/sample.css" type="text/css" media="screen" />
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?=base_url()?>javascript/core.js"></script>
    <script type="text/javascript" src="<?=base_url()?>javascript/ajax_core.js"></script>
    <script src="<?=base_url()?>javascript/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>javascript/hideshow.js" type="text/javascript"></script>
    <script src="<?=base_url()?>javascript/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>javascript/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="<?=base_url()?>javascript/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".tablesorter").tablesorter(); 
        } 
    );
    $(document).ready(function() {

    //When page loads...
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content

    //On Click Event
    $("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab_content").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active ID content
        return false;
    });

});

        var editor, html = '';

        function createEditor() {
            if ( editor )
                return;

            // Create a new editor inside the <div id="editor">, setting its value to html
            var config = {};
            editor = CKEDITOR.appendTo( 'editor', config, html );
        }

        function removeEditor() {
            if ( !editor )
                return;

            // Retrieve the editor contents. In an Ajax application, this data would be
            // sent to the server or used in any other way.
            document.getElementById( 'editorcontents' ).innerHTML = html = editor.getData();
            document.getElementById( 'contents' ).style.display = '';

            // Destroy the editor.
            editor.destroy();
            editor = null;
        }
        
        
// The instanceReady event is fired, when an instance of CKEditor has finished
// its initialization.
CKEDITOR.on( 'instanceReady', function( ev ) {
    // Show the editor name and description in the browser status bar.
    document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

    // Show this sample buttons.
    document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;
    var value = document.getElementById( 'htmlArea' ).value;

    // Check the active editing mode.
    if ( editor.mode == 'wysiwyg' )
    {
        // Insert HTML code.
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
        editor.insertHtml( value );
    }
    else
        alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;
    var value = document.getElementById( 'txtArea' ).value;

    // Check the active editing mode.
    if ( editor.mode == 'wysiwyg' )
    {
        // Insert as plain text.
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText
        editor.insertText( value );
    }
    else
        alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;
    var value = document.getElementById( 'htmlArea' ).value;

    // Set editor contents (replace current contents).
    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
    editor.setData( value );
}

function GetContents() {
    // Get the editor instance that you want to interact with.
    var editor = CKEDITOR.instances.editor1;

    // Get editor contents
    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
    alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;

    // Check the active editing mode.
    if ( editor.mode == 'wysiwyg' )
    {
        // Execute the command.
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand
        editor.execCommand( commandName );
    }
    else
        alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;
    // Checks whether the current editor contents present changes when compared
    // to the contents loaded into the editor at startup
    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty
    alert( editor.checkDirty() );
}

function ResetDirty() {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor1;
    // Resets the "dirty state" of the editor (see CheckDirty())
    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty
    editor.resetDirty();
    alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
    CKEDITOR.instances.editor1.focus();
}

function onFocus() {
    document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
    document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>
