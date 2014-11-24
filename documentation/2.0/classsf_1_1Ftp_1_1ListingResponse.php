<?php
    $version = '2.0'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Ftp::ListingResponse Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li class="current"><a href="annotated.php"><span>Classes</span></a></li>
      <li><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="annotated.php"><span>Class&#160;List</span></a></li>
      <li><a href="classes.php"><span>Class&#160;Index</span></a></li>
      <li><a href="hierarchy.php"><span>Class&#160;Hierarchy</span></a></li>
      <li><a href="functions.php"><span>Class&#160;Members</span></a></li>
    </ul>
  </div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Ftp.php">Ftp</a></li><li class="navelem"><a class="el" href="classsf_1_1Ftp_1_1ListingResponse.php">ListingResponse</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#pub-types">Public Types</a> &#124;
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="classsf_1_1Ftp_1_1ListingResponse-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">sf::Ftp::ListingResponse Class Reference<div class="ingroups"><a class="el" href="group__network.php">Network module</a></div></div>  </div>
</div><!--header-->
<div class="contents">

<p>Specialization of FTP response returning a filename lisiting.  
 <a href="classsf_1_1Ftp_1_1ListingResponse.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Ftp_8hpp_source.php">Ftp.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::Ftp::ListingResponse:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1Ftp_1_1ListingResponse.png" usemap="#sf::Ftp::ListingResponse_map" alt=""/>
  <map id="sf::Ftp::ListingResponse_map" name="sf::Ftp::ListingResponse_map">
<area href="classsf_1_1Ftp_1_1Response.php" title="Define a FTP response." alt="sf::Ftp::Response" shape="rect" coords="0,0,143,24"/>
</map>
 </div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-types"></a>
Public Types</h2></td></tr>
<tr class="memitem:af81738f06b6f571761696291276acb3b"><td class="memItemLeft" align="right" valign="top">enum &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3b">Status</a> { <br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba07e06d3326ba2d078583bef93930d909">RestartMarkerReply</a> = 110, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba22413357ade6b586f6ceb0d704f35075">ServiceReadySoon</a> = 120, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bafa52d19bc813d69055f4cc390d4a76ca">DataConnectionAlreadyOpened</a> = 125, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba794ebe743688be611447638bf9e49d86">OpeningDataConnection</a> = 150, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baa956e229ba6c0cdf0d88b0e05b286210">Ok</a> = 200, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba38adc424f1adcd332745de8cd3b7737a">PointlessCommand</a> = 202, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba9bdd02ae119b8be639e778859ee74060">SystemStatus</a> = 211, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba8729460a695013cc96330e2fced0ae1f">DirectoryStatus</a> = 212, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baebddfc7997dca289c83068dff3f47dce">FileStatus</a> = 213, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba840fd2a1872fd4310b046541f57fdeb7">HelpMessage</a> = 214, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba78391f73aa11f07f1514c7d070b93c08">SystemType</a> = 215, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baea2ee2007d7843c21108bb686ef03757">ServiceReady</a> = 220, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bab23931490fc2d1df3081d651fe0f4d6e">ClosingConnection</a> = 221, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3badc78ed87d5bddb174fa3c16707ac2f2d">DataConnectionOpened</a> = 225, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bac723ebc8a38913bbf0d9504556cbaaa6">ClosingDataConnection</a> = 226, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba48314fc47a72ad0aacdea93b91756f6e">EnteringPassiveMode</a> = 227, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba54a88210386cb72e35d737813a221754">LoggedIn</a> = 230, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baf988b69b0a5f55f8122da5ba001932e0">FileActionOk</a> = 250, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba06d26e95a170fc422af13def415e0437">DirectoryOk</a> = 257, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba9249e3fe9818eb93f181fbbf3ae3bc56">NeedPassword</a> = 331, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba9e048185f253f6eb6f5ff9e063b712fa">NeedAccountToLogIn</a> = 332, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba02e6f05964ecb829e9b6fb6020d6528a">NeedInformation</a> = 350, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba43022ddf49b68a4f5aff0bea7e09e89f">ServiceUnavailable</a> = 421, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba757b89ff1f236941f7759b0ed0c28b88">DataConnectionUnavailable</a> = 425, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba7cfefcc586c12ba70f752353fde7126e">TransferAborted</a> = 426, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baf822d1b0abf3e9ae7dd44684549d512d">FileActionAborted</a> = 450, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bae54e84baaca95a7b36271ca3f3fdb900">LocalError</a> = 451, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba5d9f3666222c808553c27e4e099c7c6d">InsufficientStorageSpace</a> = 452, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba75bdf0b6844fa9c07b3c25647d22c269">CommandUnknown</a> = 500, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baf4c7c88815981bbb7c3a3461f9f48b67">ParametersUnknown</a> = 501, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba2ca4834c756c81b924ebed696fcba0a8">CommandNotImplemented</a> = 502, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bad0c7ab07f01c1f7af16a1852650d7c47">BadCommandSequence</a> = 503, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba8807473b8590e1debfb3740b7a3d081c">ParameterNotImplemented</a> = 504, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bafcfbaff2c6fed941b6bcbc0999db764e">NotLoggedIn</a> = 530, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba1af0f173062a471739b50d8e0f40d5f7">NeedAccountToStore</a> = 532, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba3f8f931e499936fde6b750d81f5ecfef">FileUnavailable</a> = 550, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bad220bc12dc45593af6e5079ea6c532c3">PageTypeUnknown</a> = 551, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baf418e54753e0b8f9cb0325dd618acd14">NotEnoughMemory</a> = 552, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba03254aba823298179a98056e15568c5b">FilenameNotAllowed</a> = 553, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba59e041e4ef186e8ae8d6035973fc46bd">InvalidResponse</a> = 1000, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3ba51aa367cc1e85a45ea3c7be48730e990">ConnectionFailed</a> = 1001, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3bad1e5dcf298ce30c528261435f1a2eb53">ConnectionClosed</a> = 1002, 
<br/>
&#160;&#160;<a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3baed2c74a9f335dee1463ca1a4f41c6478">InvalidFile</a> = 1003
<br/>
 }</td></tr>
<tr class="memdesc:af81738f06b6f571761696291276acb3b"><td class="mdescLeft">&#160;</td><td class="mdescRight">Status codes possibly returned by a FTP response.  <a href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3b">More...</a><br/></td></tr>
<tr class="separator:af81738f06b6f571761696291276acb3b"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:aefc1b85e59ee0c3ee180666b4a4631e4"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1ListingResponse.php#aefc1b85e59ee0c3ee180666b4a4631e4">ListingResponse</a> (const <a class="el" href="classsf_1_1Ftp_1_1Response.php">Response</a> &amp;response, const std::vector&lt; char &gt; &amp;data)</td></tr>
<tr class="memdesc:aefc1b85e59ee0c3ee180666b4a4631e4"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <a href="#aefc1b85e59ee0c3ee180666b4a4631e4"></a><br/></td></tr>
<tr class="separator:aefc1b85e59ee0c3ee180666b4a4631e4"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a5f0771b52a966bf25b33a70602b6f97f"><td class="memItemLeft" align="right" valign="top">const std::vector&lt; std::string &gt; &amp;&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1ListingResponse.php#a5f0771b52a966bf25b33a70602b6f97f">getListing</a> () const </td></tr>
<tr class="memdesc:a5f0771b52a966bf25b33a70602b6f97f"><td class="mdescLeft">&#160;</td><td class="mdescRight">Return the array of directory/file names.  <a href="#a5f0771b52a966bf25b33a70602b6f97f"></a><br/></td></tr>
<tr class="separator:a5f0771b52a966bf25b33a70602b6f97f"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a4dadbe0fe0a3ef2d571a017e1645e675"><td class="memItemLeft" align="right" valign="top">bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1Response.php#a4dadbe0fe0a3ef2d571a017e1645e675">isOk</a> () const </td></tr>
<tr class="memdesc:a4dadbe0fe0a3ef2d571a017e1645e675"><td class="mdescLeft">&#160;</td><td class="mdescRight">Check if the status code means a success.  <a href="#a4dadbe0fe0a3ef2d571a017e1645e675"></a><br/></td></tr>
<tr class="separator:a4dadbe0fe0a3ef2d571a017e1645e675"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac7f937b3883d1c4fbc75c003a1786aaa"><td class="memItemLeft" align="right" valign="top"><a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3b">Status</a>&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1Response.php#ac7f937b3883d1c4fbc75c003a1786aaa">getStatus</a> () const </td></tr>
<tr class="memdesc:ac7f937b3883d1c4fbc75c003a1786aaa"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the status code of the response.  <a href="#ac7f937b3883d1c4fbc75c003a1786aaa"></a><br/></td></tr>
<tr class="separator:ac7f937b3883d1c4fbc75c003a1786aaa"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0015675c528a4a84a671484b9e5499d6"><td class="memItemLeft" align="right" valign="top">const std::string &amp;&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Ftp_1_1Response.php#a0015675c528a4a84a671484b9e5499d6">getMessage</a> () const </td></tr>
<tr class="memdesc:a0015675c528a4a84a671484b9e5499d6"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the full message contained in the response.  <a href="#a0015675c528a4a84a671484b9e5499d6"></a><br/></td></tr>
<tr class="separator:a0015675c528a4a84a671484b9e5499d6"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Specialization of FTP response returning a filename lisiting. </p>

<p>Definition at line <a class="el" href="Ftp_8hpp_source.php#l00221">221</a> of file <a class="el" href="Ftp_8hpp_source.php">Ftp.hpp</a>.</p>
</div><h2 class="groupheader">Member Enumeration Documentation</h2>
<a class="anchor" id="af81738f06b6f571761696291276acb3b"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">enum <a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3b">sf::Ftp::Response::Status</a></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">inherited</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Status codes possibly returned by a FTP response. </p>
<dl><dt><b>Enumerator: </b></dt><dd><table border="0" cellspacing="2" cellpadding="0">
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba07e06d3326ba2d078583bef93930d909"></a>RestartMarkerReply</em>&nbsp;</td><td>
<p>Restart marker reply. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba22413357ade6b586f6ceb0d704f35075"></a>ServiceReadySoon</em>&nbsp;</td><td>
<p>Service ready in N minutes. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bafa52d19bc813d69055f4cc390d4a76ca"></a>DataConnectionAlreadyOpened</em>&nbsp;</td><td>
<p>Data connection already opened, transfer starting. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba794ebe743688be611447638bf9e49d86"></a>OpeningDataConnection</em>&nbsp;</td><td>
<p>File status ok, about to open data connection. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baa956e229ba6c0cdf0d88b0e05b286210"></a>Ok</em>&nbsp;</td><td>
<p>Command ok. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba38adc424f1adcd332745de8cd3b7737a"></a>PointlessCommand</em>&nbsp;</td><td>
<p>Command not implemented. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba9bdd02ae119b8be639e778859ee74060"></a>SystemStatus</em>&nbsp;</td><td>
<p>System status, or system help reply. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba8729460a695013cc96330e2fced0ae1f"></a>DirectoryStatus</em>&nbsp;</td><td>
<p>Directory status. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baebddfc7997dca289c83068dff3f47dce"></a>FileStatus</em>&nbsp;</td><td>
<p>File status. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba840fd2a1872fd4310b046541f57fdeb7"></a>HelpMessage</em>&nbsp;</td><td>
<p>Help message. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba78391f73aa11f07f1514c7d070b93c08"></a>SystemType</em>&nbsp;</td><td>
<p>NAME system type, where NAME is an official system name from the list in the Assigned Numbers document. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baea2ee2007d7843c21108bb686ef03757"></a>ServiceReady</em>&nbsp;</td><td>
<p>Service ready for new user. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bab23931490fc2d1df3081d651fe0f4d6e"></a>ClosingConnection</em>&nbsp;</td><td>
<p>Service closing control connection. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3badc78ed87d5bddb174fa3c16707ac2f2d"></a>DataConnectionOpened</em>&nbsp;</td><td>
<p>Data connection open, no transfer in progress. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bac723ebc8a38913bbf0d9504556cbaaa6"></a>ClosingDataConnection</em>&nbsp;</td><td>
<p>Closing data connection, requested file action successful. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba48314fc47a72ad0aacdea93b91756f6e"></a>EnteringPassiveMode</em>&nbsp;</td><td>
<p>Entering passive mode. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba54a88210386cb72e35d737813a221754"></a>LoggedIn</em>&nbsp;</td><td>
<p>User logged in, proceed. Logged out if appropriate. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baf988b69b0a5f55f8122da5ba001932e0"></a>FileActionOk</em>&nbsp;</td><td>
<p>Requested file action ok. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba06d26e95a170fc422af13def415e0437"></a>DirectoryOk</em>&nbsp;</td><td>
<p>PATHNAME created. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba9249e3fe9818eb93f181fbbf3ae3bc56"></a>NeedPassword</em>&nbsp;</td><td>
<p>User name ok, need password. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba9e048185f253f6eb6f5ff9e063b712fa"></a>NeedAccountToLogIn</em>&nbsp;</td><td>
<p>Need account for login. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba02e6f05964ecb829e9b6fb6020d6528a"></a>NeedInformation</em>&nbsp;</td><td>
<p>Requested file action pending further information. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba43022ddf49b68a4f5aff0bea7e09e89f"></a>ServiceUnavailable</em>&nbsp;</td><td>
<p>Service not available, closing control connection. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba757b89ff1f236941f7759b0ed0c28b88"></a>DataConnectionUnavailable</em>&nbsp;</td><td>
<p>Can't open data connection. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba7cfefcc586c12ba70f752353fde7126e"></a>TransferAborted</em>&nbsp;</td><td>
<p>Connection closed, transfer aborted. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baf822d1b0abf3e9ae7dd44684549d512d"></a>FileActionAborted</em>&nbsp;</td><td>
<p>Requested file action not taken. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bae54e84baaca95a7b36271ca3f3fdb900"></a>LocalError</em>&nbsp;</td><td>
<p>Requested action aborted, local error in processing. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba5d9f3666222c808553c27e4e099c7c6d"></a>InsufficientStorageSpace</em>&nbsp;</td><td>
<p>Requested action not taken; insufficient storage space in system, file unavailable. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba75bdf0b6844fa9c07b3c25647d22c269"></a>CommandUnknown</em>&nbsp;</td><td>
<p>Syntax error, command unrecognized. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baf4c7c88815981bbb7c3a3461f9f48b67"></a>ParametersUnknown</em>&nbsp;</td><td>
<p>Syntax error in parameters or arguments. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba2ca4834c756c81b924ebed696fcba0a8"></a>CommandNotImplemented</em>&nbsp;</td><td>
<p>Command not implemented. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bad0c7ab07f01c1f7af16a1852650d7c47"></a>BadCommandSequence</em>&nbsp;</td><td>
<p>Bad sequence of commands. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba8807473b8590e1debfb3740b7a3d081c"></a>ParameterNotImplemented</em>&nbsp;</td><td>
<p>Command not implemented for that parameter. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bafcfbaff2c6fed941b6bcbc0999db764e"></a>NotLoggedIn</em>&nbsp;</td><td>
<p>Not logged in. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba1af0f173062a471739b50d8e0f40d5f7"></a>NeedAccountToStore</em>&nbsp;</td><td>
<p>Need account for storing files. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba3f8f931e499936fde6b750d81f5ecfef"></a>FileUnavailable</em>&nbsp;</td><td>
<p>Requested action not taken, file unavailable. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bad220bc12dc45593af6e5079ea6c532c3"></a>PageTypeUnknown</em>&nbsp;</td><td>
<p>Requested action aborted, page type unknown. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baf418e54753e0b8f9cb0325dd618acd14"></a>NotEnoughMemory</em>&nbsp;</td><td>
<p>Requested file action aborted, exceeded storage allocation. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba03254aba823298179a98056e15568c5b"></a>FilenameNotAllowed</em>&nbsp;</td><td>
<p>Requested action not taken, file name not allowed. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba59e041e4ef186e8ae8d6035973fc46bd"></a>InvalidResponse</em>&nbsp;</td><td>
<p><a class="el" href="classsf_1_1Ftp_1_1Response.php" title="Define a FTP response.">Response</a> is not a valid FTP one. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3ba51aa367cc1e85a45ea3c7be48730e990"></a>ConnectionFailed</em>&nbsp;</td><td>
<p>Connection with server failed. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3bad1e5dcf298ce30c528261435f1a2eb53"></a>ConnectionClosed</em>&nbsp;</td><td>
<p>Connection with server closed. </p>
</td></tr>
<tr><td valign="top"><em><a class="anchor" id="af81738f06b6f571761696291276acb3baed2c74a9f335dee1463ca1a4f41c6478"></a>InvalidFile</em>&nbsp;</td><td>
<p>Invalid file to upload / download. </p>
</td></tr>
</table>
</dd>
</dl>

<p>Definition at line <a class="el" href="Ftp_8hpp_source.php#l00074">74</a> of file <a class="el" href="Ftp_8hpp_source.php">Ftp.hpp</a>.</p>

</div>
</div>
<h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a class="anchor" id="aefc1b85e59ee0c3ee180666b4a4631e4"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::Ftp::ListingResponse::ListingResponse </td>
          <td>(</td>
          <td class="paramtype">const <a class="el" href="classsf_1_1Ftp_1_1Response.php">Response</a> &amp;&#160;</td>
          <td class="paramname"><em>response</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">const std::vector&lt; char &gt; &amp;&#160;</td>
          <td class="paramname"><em>data</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Default constructor. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">response</td><td>Source response </td></tr>
    <tr><td class="paramname">data</td><td>Data containing the raw listing </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<h2 class="groupheader">Member Function Documentation</h2>
<a class="anchor" id="a5f0771b52a966bf25b33a70602b6f97f"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">const std::vector&lt;std::string&gt;&amp; sf::Ftp::ListingResponse::getListing </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td> const</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Return the array of directory/file names. </p>
<dl class="section return"><dt>Returns</dt><dd>Array containing the requested listing </dd></dl>

</div>
</div>
<a class="anchor" id="a0015675c528a4a84a671484b9e5499d6"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">const std::string&amp; sf::Ftp::Response::getMessage </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td> const</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">inherited</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the full message contained in the response. </p>
<dl class="section return"><dt>Returns</dt><dd>The response message </dd></dl>

</div>
</div>
<a class="anchor" id="ac7f937b3883d1c4fbc75c003a1786aaa"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname"><a class="el" href="classsf_1_1Ftp_1_1Response.php#af81738f06b6f571761696291276acb3b">Status</a> sf::Ftp::Response::getStatus </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td> const</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">inherited</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the status code of the response. </p>
<dl class="section return"><dt>Returns</dt><dd>Status code </dd></dl>

</div>
</div>
<a class="anchor" id="a4dadbe0fe0a3ef2d571a017e1645e675"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">bool sf::Ftp::Response::isOk </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td> const</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">inherited</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Check if the status code means a success. </p>
<p>This function is defined for convenience, it is equivalent to testing if the status code is &lt; 400.</p>
<dl class="section return"><dt>Returns</dt><dd>True if the status is a success, false if it is a failure </dd></dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Ftp_8hpp_source.php">Ftp.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
