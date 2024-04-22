var listButton = document.getElementsByName('listButton');
var cardButton = document.getElementsByName('cardButton');

listButton[0].addEventListener('click', change)
cardButton[1].addEventListener('click', change)

function change() {
    let cardsDiv = document.getElementById("cards");
    let listDiv = document.getElementById("list");
   if (cardsDiv.hidden === true) {
       cardsDiv.hidden = false;
       listDiv.hidden = true;
   } else {
       cardsDiv.hidden = true;
       listDiv.hidden = false;
   }
}
