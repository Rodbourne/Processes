
$(document).ready(function()
{

   var createList = JSON.parse(data);
   var ul = document.getElementById("myUL");
         for( var i = 0; i < createList.length; i++ )
        {
               var o = createList[i];
               var li = document.createElement("li");
               li.appendChild(document.createTextNode(o.LastName + ",\t" + o.FirstName));
               ul.appendChild(li);
}
