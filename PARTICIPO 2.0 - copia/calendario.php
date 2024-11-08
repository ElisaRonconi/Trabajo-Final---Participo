<?php
require("FUNCIONES\menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="content">
    <!-- Calendario Noviembre 2024Cortesia de WinCalendar.com -->
<style>   .monthNoCol { width: 3.2%}   .monthTxtCol { width: 10.9%;}  .pnmlink{ color:#CDCDCD; font-size:0.8em; }  #Calendar {font-family:Arial, sans-serif; border-collapse: collapse; width:100%; table-layout:fixed;}   #Calendar h1 {font-size:12.0pt; font-weight:400; margin-top:0px; margin-bottom:0.1em;  font-weight:normal;}   .Saprorar{display:inline-block; width: 0.1em; height: 0; border-style: solid; border-width: 3.7px 0 3.7px 7.8px; border-color: transparent transparent transparent #f3f6fd; margin:0 0.15em;}  .Saprolar{display:inline-block; width: 0.1em; height: 0; border-style: solid; border-width: 3.7px 7.8px 3.7px 0; border-color: transparent #f3f6fd transparent transparent; margin:0 0.15em;}  #Calendar tr { height:1.2em; }   #Calendar tr:nth-child(even) {vertical-align:top; height:1.5em; }  #Calendar tr:nth-child(odd) {vertical-align:middle;}  #Calendar tr:first-child { height:1.7em; vertical-align:bottom; }   #Calendar tr:nth-child(2) {vertical-align:bottom; height:1.2em;}  #Calendar tr:first-child td:first-child { -moz-border-radius-topleft: 11px; -webkit-border-top-left-radius: 11px; border-top-left-radius: 11px;}  #Calendar tr:first-child td:last-child { -moz-border-radius-topright: 11px; -webkit-border-top-right-radius: 11px;  border-top-right-radius: 11px; }  #Calendar tr:not(:first-child) td:last-child { border-right:1.5pt solid #355986; }      .Sapro901104{color:navy; font-size:11.0pt; font-weight:700; text-align:center; border-top:1.0pt solid #355986; border-left:1.0pt solid #355986; } .Sapro911104{color:maroon; font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; } .Sapro921104{color:navy; font-size:11.0pt; font-weight:700; text-align:center; border-top:1.0pt solid #355986; border-left:1.0pt solid #355986; background:#F9F9E1; } .Sapro931104{color:maroon; font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; border-right:1.5pt solid #355986; background:#F9F9E1; } .Sapro941104{color:navy; font-size:11.0pt; font-weight:700; text-align:center; border-top:1.0pt solid #355986; border-left:1.5pt solid #355986; background:#F9F9E1; } .Sapro951104{color:maroon; font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; background:#F9F9E1; } .Sapro961104{font-size:12.0pt; } .Sapro971104{color:white; font-size:10.0pt; text-align:center; border-top:1.0pt solid white; border-right:1.0pt solid white; border-left:1.5pt solid #355986; background:#355986; } .Sapro981104{color:white; font-size:10.0pt; text-align:center; border-top:1.0pt solid white; border-right:1.0pt solid white; border-left:1.0pt solid white; background:#355986; } .Sapro1001104{font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; border-left:1.5pt solid #355986; background:#D9D9D9; } .Sapro1011104{font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; background:#D9D9D9; } .Sapro1021104{font-size:0.8em; text-align:left; border-top:1.0pt solid #355986; border-left:1.0pt solid #355986; background:#D9D9D9; } .Sapro1031104{font-size:0.8em; text-align:left; border-left:1.5pt solid #355986; background:#D9D9D9; } .Sapro1051104{font-size:0.8em; text-align:left; border-left:1.0pt solid #355986; background:#D9D9D9; } .Sapro1061104{font-size:0.8em; text-align:left; border-left:1.0pt solid #355986; } .Sapro1081104{font-size:0.8em; text-align:left; border-left:1.0pt solid #355986; background:#F9F9E1; } .Sapro1101104{font-size:0.8em; text-align:left; border-left:1.5pt solid #355986; background:#F9F9E1; } .Sapro1121104{font-size:0.8em; text-align:left; border-bottom:1.5pt solid #355986; border-left:1.5pt solid #355986; background:#F9F9E1; } .Sapro1141104{font-size:0.8em; text-align:left; border-bottom:1.5pt solid #355986; border-left:1.0pt solid #355986; } .Sapro1161104{font-size:0.8em; text-align:left; border-bottom:1.5pt solid #355986; border-left:1.0pt solid #355986; background:#F9F9E1; } .Sapro1191104{color:white; font-size:12.0pt; text-align:center; border-bottom:1.0pt solid white; background:#355986; } .Sapro1201104{color:#CDCDCD; font-size:0.8em; text-align:right; border-bottom:1.0pt solid white; background:#355986; } .Sapro1221104{color:#CDCDCD; font-size:0.8em; text-align:left; border-bottom:1.0pt solid white; background:#355986; } </style>
<table id='Calendar' data-month=202411 border=0 cellpadding=0 cellspacing=0>
 <colgroup>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
  <col class='monthNoCol'><col class='monthTxtCol'>
</colgroup>
<tr class=Sapro961104>
  <td colspan=4 class=Sapro1221104><a href="https://www.wincalendar.com/calendario/Argentina/Octubre-2024" title="Octubre 2024"><div class="Saprolar"></div><span class="pnmlink">Oct 2024</span></a></td>
  <td colspan=6 class=Sapro1191104><h1>Calendario Noviembre 2024</h1></td>
  <td colspan=4 class=Sapro1201104><a href="https://www.wincalendar.com/calendario/Argentina/Diciembre-2024" title="Diciembre 2024"><span class="pnmlink">Dic 2024</span><div class="Saprorar"></div></a></td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro971104>Dom</td>
  <td colspan=2 class=Sapro981104>Lun</td>
  <td colspan=2 class=Sapro981104>Mar</td>
  <td colspan=2 class=Sapro981104>Mié</td>
  <td colspan=2 class=Sapro981104>Jue</td>
  <td colspan=2 class=Sapro981104>Vie</td>
  <td colspan=2 class=Sapro981104>Sáb</td>
 </tr>
 <tr>
  <td class=Sapro1001104> </td>
  <td class=Sapro1011104> </td>
  <td class=Sapro1021104> </td>
  <td class=Sapro1011104> </td>
  <td class=Sapro1021104> </td>
  <td class=Sapro1011104> </td>
  <td class=Sapro1021104> </td>
  <td class=Sapro1011104> </td>
  <td class=Sapro1021104> </td>
  <td class=Sapro1011104> </td>
  <td class=Sapro901104>1</td>
  <td class=Sapro911104> </td>
  <td class=Sapro921104>2</td>
  <td class=Sapro931104> </td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro1031104> </td>
  <td colspan=2 class=Sapro1051104> </td>
  <td colspan=2 class=Sapro1051104> </td>
  <td colspan=2 class=Sapro1051104> </td>
  <td colspan=2 class=Sapro1051104> </td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1081104></td>
 </tr>
 <tr>
  <td class=Sapro941104>3</td>
  <td class=Sapro951104> </td>
  <td class=Sapro901104>4</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>5</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>6</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>7</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>8</td>
  <td class=Sapro911104> </td>
  <td class=Sapro921104>9</td>
  <td class=Sapro931104> </td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro1101104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1081104></td>
 </tr>
 <tr>
  <td class=Sapro941104>10</td>
  <td class=Sapro951104> </td>
  <td class=Sapro901104>11</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>12</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>13</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>14</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>15</td>
  <td class=Sapro911104> </td>
  <td class=Sapro921104>16</td>
  <td class=Sapro931104> </td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro1101104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1081104></td>
 </tr>
 <tr>
  <td class=Sapro941104>17</td>
  <td class=Sapro951104> </td>
  <td class=Sapro901104>18</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>19</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>20</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>21</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>22</td>
  <td class=Sapro911104> </td>
  <td class=Sapro921104>23</td>
  <td class=Sapro931104> </td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro1101104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1061104></td>
  <td colspan=2 class=Sapro1081104></td>
 </tr>
 <tr>
  <td class=Sapro941104>24</td>
  <td class=Sapro951104> </td>
  <td class=Sapro901104>25</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>26</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>27</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>28</td>
  <td class=Sapro911104> </td>
  <td class=Sapro901104>29</td>
  <td class=Sapro911104> </td>
  <td class=Sapro921104>30</td>
  <td class=Sapro931104> </td>
 </tr>
 <tr>
  <td colspan=2 class=Sapro1121104></td>
  <td colspan=2 class=Sapro1141104></td>
  <td colspan=2 class=Sapro1141104></td>
  <td colspan=2 class=Sapro1141104></td>
  <td colspan=2 class=Sapro1141104></td>
  <td colspan=2 class=Sapro1141104></td>
  <td colspan=2 class=Sapro1161104></td>
 </tr>
 
</table>

</body>
</html>