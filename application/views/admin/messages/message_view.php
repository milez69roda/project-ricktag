 
	
 <script>
$(function() {
	
		Messages = {
			adminReply: function(d){
				if( confirm('Confirm Reply') ){
					
					$.ajax({
						type: 'post',
						url: 'admin/ajax_savereply',
						data: $(d).serialize(),
						dataType: 'json',
						success: function(json){
  
							$(".MessageList").append(json.reply);
							$("#Comment_"+json.mbc).fadeIn().animate({ backgroundColor: '#CCC' }) .animate({ backgroundColor: '#ffff' });								
							 
							$("#Comment_Body").attr('value', '');
						}
					}); 
					return false;
				}else{
					return false;
				}
			}
		}	
 

});
</script>

<style>

 
ul.MessageList, ul.MessageList li {
    list-style: none outside none;
    margin: 0;
    padding: 0;
}
ul.MessageList li.Item {
    border-bottom: 1px solid #BEC8CC;
    padding: 10px 10px 4px;
}
ul.MessageList div.Meta {
    color: #777777;
    font-size: 11px;
    min-height: 40px; 
}
ul.MessageList div.Meta span.Author img {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none;
    float: left;
    height: 40px;
    margin: 0 10px 0 0;
    overflow: hidden;
    width: 40px;
}
ul.MessageList div.Meta span {
    line-height: 2.5;
     
}
ul.MessageList div.Meta span.Author {
    padding: 5px;
	font-weight: bold;
	font-size: 13px;
	color: #4E6CA3;
	border: 1px solid #BEC8CC;
}
ul.MessageList div.Meta span.Author a {
    font-size: 15px;
    font-weight: bold;
}
ul.MessageList div.Meta span {
    line-height: inherit;
}
ul.MessageList div.Meta div.CommentInfo {
    line-height: normal;
}
ul.MessageList div.Meta div.CommentInfo span {
    padding-left: 0;
    padding-right: 10px;
}

div.Preview div.Message, ul.MessageList div.Message {
    clear: both;
    font-size: 100%;
    line-height: 140%;
    word-wrap: break-word;
}
div.Preview div.Message, div.Preview div.Message p, ul.MessageList div.Message, ul.MessageList div.Message p {
    margin: 8px 0;
}
div.Preview div.Message blockquote, ul.MessageList div.Message blockquote {
    margin: 4px 0;
    padding: 4px 16px;
}
ul.MessageList div.Message small {
    color: #777777;
    font-size: 11px;
}
code, pre {
    background: none repeat scroll 0 0 #FFFF99;
    border: 1px solid #EEEECC;
    border-radius: 2px 2px 2px 2px;
    font-family: monospace;
    overflow: auto;
    padding: 4px 8px;
    white-space: pre;
}
 
div.Preview div.Message strong, ul.MessageList div.Message strong {
    font-weight: bold;
}
div.Preview div.Message em, ul.MessageList div.Message em {
    font-style: oblique;
}
div.Preview div.Message ul, div.Preview div.Message ol, ul.MessageList div.Message ul, ul.MessageList div.Message ol {
    margin-left: 3em !important;
}
div.Preview div.Message ol li, ul.MessageList div.Message ol li {
    list-style: decimal outside none !important;
}
div.Preview div.Message ul li, ul.MessageList div.Message ul li {
    list-style: disc outside none !important;
}
div.Message h1, div.Message h2, div.Message h3, div.Message h4, div.Message h5 {
    border: medium none;
    color: #000000;
    font-family: 'lucida grande','Lucida Sans Unicode',tahoma,sans-serif;
    font-weight: bold;
}
 
#Form_Body {
    font-size: 13px;
    padding: 10px;
}
textarea.TextBox {
    height: 100px;
    margin: 0 0 6px;
    min-height: 100px;
    width: 100%;
}
textarea.TextBox {
    height: 100px;
    min-height: 100px;
    width: 500px;
}

textarea {
    border: 1px solid #AAAAAA;
    border-radius: 2px 2px 2px 2px;
    color: #333333;
    font-family: 'lucida grande','Lucida Sans Unicode',tahoma,sans-serif;
    font-size: 15px;
    margin: 0;
    padding: 3px;
    width: 250px;
}

input.Button {
    font-size: 14px;
    font-weight: bold;
}
a.Button, .Button {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 0 2px #999999;
    color: #02475A;
    cursor: pointer;
    font-size: 11px;
    margin: 0;
    padding: 4px;
    text-shadow: 0 1px 0 #FFFFFF;
    white-space: nowrap;
}
</style>
<div id="content" class="box">

	<h2><a href="admin/messages">Operator's Ticker</a> / Vew</h2>
	 
	<ul class="MessageList Discussion FirstPage">
		<li id="Discussion_" class="Item Comment FirstComment">
			<div class="Comment">
				<!--<div class="Meta">-->
					<!--<span class="Author"><?php echo ($message->owner_isadmin)?'<strong style="color:red">Ricktag Team ('.$message->admin_user.')</strong>':$message->op_user; ?>  </span>-->
					<!--<span class="DateCreated"> <?php echo date('F j, Y g:i a', strtotime($message->date_created)); ?> </span>-->
					<!--<div class="CommentInfo"> <span>Posts: 23</span>  </div>-->
				<!--</div>-->
				<div class="Message">
					<h2 style="color:#4E6CA3; font-size: 14px; padding-bottom: 10px"><?php echo $message->msg_subject; ?></h2> 
					<?php //echo str_replace(array("\r\n"), '<br />', $message->msg_text); ?>
				</div>
			</div>
		</li>
		<?php foreach(  $reply as $row ): ?>
		<li id="Comment_<?php echo $row->mbc_id; ?>" class="Item Comment Alt">		
		   <div class="Comment">
				<div class="Meta">
					<span class="Author" ><?php echo @(($row->isAdmin)?'<strong style="color:red">Ricktag Team ('.$row->op_user.')</strong>':$row->op_user); ?> </span>
					<span class="DateCreated"><?php echo date('F j, Y g:i a', strtotime($row->date_created)); ?></span>
					<!--<div class="CommentInfo"> <span>Posts: 15,423</span> </div>-->
				</div>
				<div class="Message">
					<?php echo str_replace(array("\r\n"), '<br />',$row->comment_text); ?>		
				</div>
				 
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<div>
	
		<form id="Form_Comment" action="" method="post" onsubmit="return Messages.adminReply(this)">
			<div class="TextBoxWrapper">
				<input type="hidden" name="m" value="<?php echo $message->mid ?>">
				<textarea class="TextBox" cols="100" rows="6" name="Comment_Body" id="Comment_Body" style="overflow: hidden; display: block;"></textarea>
				<div class="Buttons"> 
				<input type="submit" class="Button CommentButton" value="Reply" name="Post_Comment" id="Form_PostComment">
				</div>		
			</div>	
		</form>	
	</div>
	
	</div>
	
</div>	