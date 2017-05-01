/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function ()
{
    $(".pnl-prodcuto").hide();
    $(".eye-open").click(function()
    {
        var _id = $(this).attr('_id');
        $("#"+_id).show();
    });
    
    $(".eye-close").click(function()
    {
        var _id = $(this).attr('_id');
        $("#"+_id).hide();
    });
    
});