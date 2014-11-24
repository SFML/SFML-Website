<?php
    $version = '2.0'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li><a href="annotated.php"><span>Classes</span></a></li>
      <li class="current"><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="files.php"><span>File&#160;List</span></a></li>
    </ul>
  </div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><a class="el" href="dir_a0fcb5a19f655e235834e6382998c7e0.php">sfml</a></li><li class="navelem"><a class="el" href="dir_29bf4fae8a8e962aff98775afacdab0f.php">sfml</a></li><li class="navelem"><a class="el" href="dir_793f6ba77cf4e8a5d963fd5c095c876f.php">extlibs</a></li><li class="navelem"><a class="el" href="dir_68d8c18478ca54c694885cb8cbc52e5a.php">headers</a></li><li class="navelem"><a class="el" href="dir_1659f8737ee18542010349efee4175b2.php">libfreetype</a></li><li class="navelem"><a class="el" href="dir_8d72d6c3adad3bcfb58fa15e2b0d2e4e.php">windows</a></li><li class="navelem"><a class="el" href="dir_80e8051d9d307039295ff8d82b0d0825.php">freetype</a></li><li class="navelem"><a class="el" href="dir_68f2a82c7fb3cd35dc78c39d1445073b.php">config</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">ftstdlib.h</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">/***************************************************************************/</span></div>
<div class="line"><a name="l00002"></a><span class="lineno">    2</span>&#160;<span class="comment">/*                                                                         */</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">/*  ftstdlib.h                                                             */</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">/*                                                                         */</span></div>
<div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">/*    ANSI-specific library and header configuration file (specification   */</span></div>
<div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">/*    only).                                                               */</span></div>
<div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">/*                                                                         */</span></div>
<div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">/*  Copyright 2002, 2003, 2004, 2005, 2006, 2007, 2009 by                  */</span></div>
<div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">/*  David Turner, Robert Wilhelm, and Werner Lemberg.                      */</span></div>
<div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">/*                                                                         */</span></div>
<div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">/*  This file is part of the FreeType project, and may only be used,       */</span></div>
<div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">/*  modified, and distributed under the terms of the FreeType project      */</span></div>
<div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">/*  license, LICENSE.TXT.  By continuing to use, modify, or distribute     */</span></div>
<div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">/*  this file you indicate that you have read the license and              */</span></div>
<div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">/*  understand and accept it fully.                                        */</span></div>
<div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">/*                                                                         */</span></div>
<div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">/***************************************************************************/</span></div>
<div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;</div>
<div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;</div>
<div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;  <span class="comment">/*************************************************************************/</span></div>
<div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;  <span class="comment">/*                                                                       */</span></div>
<div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;  <span class="comment">/* This file is used to group all #includes to the ANSI C library that   */</span></div>
<div class="line"><a name="l00023"></a><span class="lineno">   23</span>&#160;  <span class="comment">/* FreeType normally requires.  It also defines macros to rename the     */</span></div>
<div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;  <span class="comment">/* standard functions within the FreeType source code.                   */</span></div>
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;  <span class="comment">/*                                                                       */</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;  <span class="comment">/* Load a file which defines __FTSTDLIB_H__ before this one to override  */</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;  <span class="comment">/* it.                                                                   */</span></div>
<div class="line"><a name="l00028"></a><span class="lineno">   28</span>&#160;  <span class="comment">/*                                                                       */</span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;  <span class="comment">/*************************************************************************/</span></div>
<div class="line"><a name="l00030"></a><span class="lineno">   30</span>&#160;</div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;</div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#ifndef __FTSTDLIB_H__</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define __FTSTDLIB_H__</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;stddef.h&gt;</span></div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="preprocessor">#define ft_ptrdiff_t  ptrdiff_t</span></div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;</div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00042"></a><span class="lineno">   42</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;  <span class="comment">/*                           integer limits                           */</span></div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;  <span class="comment">/* UINT_MAX and ULONG_MAX are used to automatically compute the size  */</span></div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;  <span class="comment">/* of `int&#39; and `long&#39; in bytes at compile-time.  So far, this works  */</span></div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;  <span class="comment">/* for all platforms the library has been tested on.                  */</span></div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;  <span class="comment">/* Note that on the extremely rare platforms that do not provide      */</span></div>
<div class="line"><a name="l00050"></a><span class="lineno">   50</span>&#160;  <span class="comment">/* integer types that are _exactly_ 16 and 32 bits wide (e.g. some    */</span></div>
<div class="line"><a name="l00051"></a><span class="lineno">   51</span>&#160;  <span class="comment">/* old Crays where `int&#39; is 36 bits), we do not make any guarantee    */</span></div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;  <span class="comment">/* about the correct behaviour of FT2 with all fonts.                 */</span></div>
<div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00054"></a><span class="lineno">   54</span>&#160;  <span class="comment">/* In these case, `ftconfig.h&#39; will refuse to compile anyway with a   */</span></div>
<div class="line"><a name="l00055"></a><span class="lineno">   55</span>&#160;  <span class="comment">/* message like `couldn&#39;t find 32-bit type&#39; or something similar.     */</span></div>
<div class="line"><a name="l00056"></a><span class="lineno">   56</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00057"></a><span class="lineno">   57</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00058"></a><span class="lineno">   58</span>&#160;</div>
<div class="line"><a name="l00059"></a><span class="lineno">   59</span>&#160;</div>
<div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;<span class="preprocessor">#include &lt;limits.h&gt;</span></div>
<div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;</div>
<div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;<span class="preprocessor">#define FT_CHAR_BIT   CHAR_BIT</span></div>
<div class="line"><a name="l00063"></a><span class="lineno">   63</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define FT_INT_MAX    INT_MAX</span></div>
<div class="line"><a name="l00064"></a><span class="lineno">   64</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define FT_INT_MIN    INT_MIN</span></div>
<div class="line"><a name="l00065"></a><span class="lineno">   65</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define FT_UINT_MAX   UINT_MAX</span></div>
<div class="line"><a name="l00066"></a><span class="lineno">   66</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define FT_ULONG_MAX  ULONG_MAX</span></div>
<div class="line"><a name="l00067"></a><span class="lineno">   67</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00068"></a><span class="lineno">   68</span>&#160;</div>
<div class="line"><a name="l00069"></a><span class="lineno">   69</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;  <span class="comment">/*                 character and string processing                    */</span></div>
<div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00073"></a><span class="lineno">   73</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00074"></a><span class="lineno">   74</span>&#160;</div>
<div class="line"><a name="l00075"></a><span class="lineno">   75</span>&#160;</div>
<div class="line"><a name="l00076"></a><span class="lineno">   76</span>&#160;<span class="preprocessor">#include &lt;string.h&gt;</span></div>
<div class="line"><a name="l00077"></a><span class="lineno">   77</span>&#160;</div>
<div class="line"><a name="l00078"></a><span class="lineno">   78</span>&#160;<span class="preprocessor">#define ft_memchr   memchr</span></div>
<div class="line"><a name="l00079"></a><span class="lineno">   79</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_memcmp   memcmp</span></div>
<div class="line"><a name="l00080"></a><span class="lineno">   80</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_memcpy   memcpy</span></div>
<div class="line"><a name="l00081"></a><span class="lineno">   81</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_memmove  memmove</span></div>
<div class="line"><a name="l00082"></a><span class="lineno">   82</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_memset   memset</span></div>
<div class="line"><a name="l00083"></a><span class="lineno">   83</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strcat   strcat</span></div>
<div class="line"><a name="l00084"></a><span class="lineno">   84</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strcmp   strcmp</span></div>
<div class="line"><a name="l00085"></a><span class="lineno">   85</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strcpy   strcpy</span></div>
<div class="line"><a name="l00086"></a><span class="lineno">   86</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strlen   strlen</span></div>
<div class="line"><a name="l00087"></a><span class="lineno">   87</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strncmp  strncmp</span></div>
<div class="line"><a name="l00088"></a><span class="lineno">   88</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strncpy  strncpy</span></div>
<div class="line"><a name="l00089"></a><span class="lineno">   89</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strrchr  strrchr</span></div>
<div class="line"><a name="l00090"></a><span class="lineno">   90</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_strstr   strstr</span></div>
<div class="line"><a name="l00091"></a><span class="lineno">   91</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00092"></a><span class="lineno">   92</span>&#160;</div>
<div class="line"><a name="l00093"></a><span class="lineno">   93</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00094"></a><span class="lineno">   94</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00095"></a><span class="lineno">   95</span>&#160;  <span class="comment">/*                           file handling                            */</span></div>
<div class="line"><a name="l00096"></a><span class="lineno">   96</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00097"></a><span class="lineno">   97</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00098"></a><span class="lineno">   98</span>&#160;</div>
<div class="line"><a name="l00099"></a><span class="lineno">   99</span>&#160;</div>
<div class="line"><a name="l00100"></a><span class="lineno">  100</span>&#160;<span class="preprocessor">#include &lt;stdio.h&gt;</span></div>
<div class="line"><a name="l00101"></a><span class="lineno">  101</span>&#160;</div>
<div class="line"><a name="l00102"></a><span class="lineno">  102</span>&#160;<span class="preprocessor">#define FT_FILE     FILE</span></div>
<div class="line"><a name="l00103"></a><span class="lineno">  103</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_fclose   fclose</span></div>
<div class="line"><a name="l00104"></a><span class="lineno">  104</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_fopen    fopen</span></div>
<div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_fread    fread</span></div>
<div class="line"><a name="l00106"></a><span class="lineno">  106</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_fseek    fseek</span></div>
<div class="line"><a name="l00107"></a><span class="lineno">  107</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_ftell    ftell</span></div>
<div class="line"><a name="l00108"></a><span class="lineno">  108</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_sprintf  sprintf</span></div>
<div class="line"><a name="l00109"></a><span class="lineno">  109</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;</div>
<div class="line"><a name="l00111"></a><span class="lineno">  111</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00112"></a><span class="lineno">  112</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00113"></a><span class="lineno">  113</span>&#160;  <span class="comment">/*                             sorting                                */</span></div>
<div class="line"><a name="l00114"></a><span class="lineno">  114</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00115"></a><span class="lineno">  115</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00116"></a><span class="lineno">  116</span>&#160;</div>
<div class="line"><a name="l00117"></a><span class="lineno">  117</span>&#160;</div>
<div class="line"><a name="l00118"></a><span class="lineno">  118</span>&#160;<span class="preprocessor">#include &lt;stdlib.h&gt;</span></div>
<div class="line"><a name="l00119"></a><span class="lineno">  119</span>&#160;</div>
<div class="line"><a name="l00120"></a><span class="lineno">  120</span>&#160;<span class="preprocessor">#define ft_qsort  qsort</span></div>
<div class="line"><a name="l00121"></a><span class="lineno">  121</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;</div>
<div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00125"></a><span class="lineno">  125</span>&#160;  <span class="comment">/*                        memory allocation                           */</span></div>
<div class="line"><a name="l00126"></a><span class="lineno">  126</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00127"></a><span class="lineno">  127</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00128"></a><span class="lineno">  128</span>&#160;</div>
<div class="line"><a name="l00129"></a><span class="lineno">  129</span>&#160;</div>
<div class="line"><a name="l00130"></a><span class="lineno">  130</span>&#160;<span class="preprocessor">#define ft_scalloc   calloc</span></div>
<div class="line"><a name="l00131"></a><span class="lineno">  131</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_sfree     free</span></div>
<div class="line"><a name="l00132"></a><span class="lineno">  132</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_smalloc   malloc</span></div>
<div class="line"><a name="l00133"></a><span class="lineno">  133</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_srealloc  realloc</span></div>
<div class="line"><a name="l00134"></a><span class="lineno">  134</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00135"></a><span class="lineno">  135</span>&#160;</div>
<div class="line"><a name="l00136"></a><span class="lineno">  136</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00137"></a><span class="lineno">  137</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00138"></a><span class="lineno">  138</span>&#160;  <span class="comment">/*                          miscellaneous                             */</span></div>
<div class="line"><a name="l00139"></a><span class="lineno">  139</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00140"></a><span class="lineno">  140</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00141"></a><span class="lineno">  141</span>&#160;</div>
<div class="line"><a name="l00142"></a><span class="lineno">  142</span>&#160;</div>
<div class="line"><a name="l00143"></a><span class="lineno">  143</span>&#160;<span class="preprocessor">#define ft_atol   atol</span></div>
<div class="line"><a name="l00144"></a><span class="lineno">  144</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_labs   labs</span></div>
<div class="line"><a name="l00145"></a><span class="lineno">  145</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00146"></a><span class="lineno">  146</span>&#160;</div>
<div class="line"><a name="l00147"></a><span class="lineno">  147</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00148"></a><span class="lineno">  148</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00149"></a><span class="lineno">  149</span>&#160;  <span class="comment">/*                         execution control                          */</span></div>
<div class="line"><a name="l00150"></a><span class="lineno">  150</span>&#160;  <span class="comment">/*                                                                    */</span></div>
<div class="line"><a name="l00151"></a><span class="lineno">  151</span>&#160;  <span class="comment">/**********************************************************************/</span></div>
<div class="line"><a name="l00152"></a><span class="lineno">  152</span>&#160;</div>
<div class="line"><a name="l00153"></a><span class="lineno">  153</span>&#160;</div>
<div class="line"><a name="l00154"></a><span class="lineno">  154</span>&#160;<span class="preprocessor">#include &lt;setjmp.h&gt;</span></div>
<div class="line"><a name="l00155"></a><span class="lineno">  155</span>&#160;</div>
<div class="line"><a name="l00156"></a><span class="lineno">  156</span>&#160;<span class="preprocessor">#define ft_jmp_buf     jmp_buf  </span><span class="comment">/* note: this cannot be a typedef since */</span><span class="preprocessor"></span></div>
<div class="line"><a name="l00157"></a><span class="lineno">  157</span>&#160;<span class="preprocessor"></span>                                <span class="comment">/*       jmp_buf is defined as a macro  */</span></div>
<div class="line"><a name="l00158"></a><span class="lineno">  158</span>&#160;                                <span class="comment">/*       on certain platforms           */</span></div>
<div class="line"><a name="l00159"></a><span class="lineno">  159</span>&#160;</div>
<div class="line"><a name="l00160"></a><span class="lineno">  160</span>&#160;<span class="preprocessor">#define ft_longjmp     longjmp</span></div>
<div class="line"><a name="l00161"></a><span class="lineno">  161</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define ft_setjmp( b ) setjmp( *(jmp_buf*) &amp;(b) )    </span><span class="comment">/* same thing here */</span><span class="preprocessor"></span></div>
<div class="line"><a name="l00162"></a><span class="lineno">  162</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00163"></a><span class="lineno">  163</span>&#160;</div>
<div class="line"><a name="l00164"></a><span class="lineno">  164</span>&#160;  <span class="comment">/* the following is only used for debugging purposes, i.e., if */</span></div>
<div class="line"><a name="l00165"></a><span class="lineno">  165</span>&#160;  <span class="comment">/* FT_DEBUG_LEVEL_ERROR or FT_DEBUG_LEVEL_TRACE are defined    */</span></div>
<div class="line"><a name="l00166"></a><span class="lineno">  166</span>&#160;</div>
<div class="line"><a name="l00167"></a><span class="lineno">  167</span>&#160;<span class="preprocessor">#include &lt;stdarg.h&gt;</span></div>
<div class="line"><a name="l00168"></a><span class="lineno">  168</span>&#160;</div>
<div class="line"><a name="l00169"></a><span class="lineno">  169</span>&#160;</div>
<div class="line"><a name="l00170"></a><span class="lineno">  170</span>&#160;<span class="preprocessor">#endif </span><span class="comment">/* __FTSTDLIB_H__ */</span><span class="preprocessor"></span></div>
<div class="line"><a name="l00171"></a><span class="lineno">  171</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00172"></a><span class="lineno">  172</span>&#160;</div>
<div class="line"><a name="l00173"></a><span class="lineno">  173</span>&#160;<span class="comment">/* END */</span></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
