

// ------------------------Rénitialise les 2 listes déroulantes et la barre de recherche lors du rechargement de la page
window.addEventListener("load", function() {
  document.getElementById("first").value = "";
  document.getElementById("second").value = "";
  document.getElementById("searchInput").value = "";;
});

// ------------------------Remplir les options de la 2ème liste déroulante en fonction de la 1ere liste déroulante
function fill() {
  let first = document.getElementById("first").value;
  let second = document.getElementById("second");
  
  // réinitialiser la liste déroulante 2 si une nouvelle formation est sélectionnée
  if(first != '' && second != '') {
      second.value = '';
  }

  $.ajax({
      type: "POST",
      url: "get_groups.php",
      data: { formation_id: first },
      success: function(groups) {
        try {
            groups = JSON.parse(groups);
            if(first == '') {
              second.innerHTML = "<option value='' >Choisissez d'abord une filière</option>";
            } else {
              second.innerHTML = "<option value='' >Choisissez un groupe</option>";
            }
            for (let i = 0; i < groups.length; i++) {
              second.innerHTML = second.innerHTML + "<option value='" + groups[i].id + "'>" + groups[i].nom_groupe + "</option>";
            }
        } catch (error) {
          console.error("Error parsing JSON: " + error);
          console.log(groups);
        }
      }
  });
}

// ------------------------Filtrer le resultat en fonction des 2 listes déroulantes

const list1 = document.getElementById("first"); // liste déroulante 1
const list2 = document.getElementById("second"); // liste déroulante 2
const divs = document.querySelectorAll(".container-trombino .box"); // tous les boîtes

let filteredDivs = Array.from(divs); // tableau pour stocker les boîtes correspondantes
let numberOfItems = 12;
let firstIndex = 0;
let actualPage = 1;
showList();

list1.addEventListener("change", function() {
  fill();
  filter();
}); // événement sur la liste déroulante 1

list2.addEventListener("change", filter); // événement sur la liste déroulante 2

function filter() {
  filteredDivs = [];
  const category = list1.value; // option courant de la liste déroulante 1
  const subcategory = list2.value; // option courant de la liste déroulante 2

  for (const div of divs) {

    div.style.display = "none";

    if (category && subcategory) { // si la boîte courante correspond à la formation et le groupe choisi
      if (div.classList.contains(category) && div.classList.contains(subcategory)) {
        filteredDivs.push(div);
      }
    } else if (category) { // si la boîte courante correspond uniquement à la formation choisie
      if (div.classList.contains(category)) {
        filteredDivs.push(div);
      }
    } else { // par défaut on affiche tout
      filteredDivs.push(div);
    }
  }

  firstIndex = 0;
  actualPage = 1;
  showList();
  
}

// ------------------------Pagination en fonction du choix de la formation et/ou du groupe

function nextPage() {
  if (firstIndex + numberOfItems < filteredDivs.length) {
    firstIndex += numberOfItems;
    actualPage++;
    showList();
  }
}

function previous() {
  if (firstIndex - numberOfItems >= 0) {
    firstIndex -= numberOfItems;
    actualPage--;
    showList();
  }
}

function firstPage() {
  firstIndex = 0;
  actualPage = 1;
  showList();
}

function lastPage() {
  firstIndex = filteredDivs.length - (filteredDivs.length % numberOfItems);
  actualPage = Math.ceil(filteredDivs.length / numberOfItems);
  showList();
}

function showList() {

  showPageInfo();

  if (filteredDivs.length === 0) {
    const errorMessage = document.querySelector(".error-message");
    errorMessage.style.display = "block";
    document.querySelector(".pagination").style.display = "none";
  } else {
    const errorMessage = document.querySelector(".error-message");
    errorMessage.style.display = "none";

    document.querySelector(".pagination").style.display = "block";

    for (const div of divs) {
      div.style.display = "none";
    }
  
    for (let i = firstIndex; i < firstIndex + numberOfItems; i++) {
      if (filteredDivs[i]) {
        filteredDivs[i].style.display = "block";
        fadeIn(filteredDivs[i]);
      }
    }
  }

}

function showPageInfo() {
  document.getElementById("pageInfo").innerHTML = `Page ${actualPage} / ${Math.ceil(filteredDivs.length / numberOfItems)}`;
}

// ----------------------animation fadeIn pour l'affichage des resultats
function fadeIn(el) {
  el.style.opacity = 0;
  let last = +new Date();
  let tick = function() {
    el.style.opacity = +el.style.opacity + (new Date() - last) / 400;
    last = +new Date();
    if (+el.style.opacity < 1) {
        (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
      }
    };
    tick();
}



// ----------------------Ajout de la barre de recherche
const searchInput = document.getElementById("searchInput");
searchInput.addEventListener("input", function() {
  filteredDivs = [];
  const searchTerm = searchInput.value.toLowerCase(); // terme de recherche saisi par l'utilisateur
  const category = list1.value; // option courant de la liste déroulante 1
  const subcategory = list2.value; // option courant de la liste déroulante 2

  for (const div of divs) {
    div.style.display = "none";

    // Recherche en fonction du terme de recherche, du choix de la liste déroulante 1 et du choix de la liste déroulante 2
    if (searchTerm && category && subcategory) { 
      if (div.innerText.toLowerCase().includes(searchTerm) && div.classList.contains(category) && div.classList.contains(subcategory)) {
        filteredDivs.push(div);
      }
    } else if (searchTerm && category) { 
      if (div.innerText.toLowerCase().includes(searchTerm) && div.classList.contains(category)) {
        filteredDivs.push(div);
      }
    } else if (searchTerm) { 
      if (div.innerText.toLowerCase().includes(searchTerm)) {
        filteredDivs.push(div);
      }
    } else if (category && subcategory) { 
      if (div.classList.contains(category) && div.classList.contains(subcategory)) {
        filteredDivs.push(div);
      }
    } else if (category) { 
      if (div.classList.contains(category)) {
        filteredDivs.push(div);
      }
    } else { 
      filteredDivs.push(div);
    }
  }

  firstIndex = 0;
  actualPage = 1;
  showList();
});

function generatePDF() {
  var logo = new Image();
  logo.src = 'images/clg.png';
  logo.onload = function() {
    var canvas = document.createElement('canvas');
    canvas.width = logo.width;
    canvas.height = logo.height;

    var ctx = canvas.getContext('2d');
    ctx.drawImage(logo, 0, 0);

    var dataURL = canvas.toDataURL('image/png');

    var doc = new jsPDF({
      orientation: 'landscape'
    });

   
    var pageHeight = doc.internal.pageSize.height;
    var pageWidth = doc.internal.pageSize.width;
    var counter = 0;
    var itemsPerRow = 4;
    var x = 30;
    var y = 50;

    // titre
    doc.setFont("helvetica", "bold");
    doc.setFontSize(22);
    var title = "Trombinoscope";
    var titleWidth = doc.getStringUnitWidth(title) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    var titleX = (pageWidth - titleWidth) / 2;
    doc.text(title, titleX, 20); 

    // sous-titre
    doc.setFont("helvetica", "bold");
    doc.setTextColor(23, 162, 184);
    doc.setFontSize(16);
    var h2 = filteredDivs[0].querySelector('.etu_pr').innerText;
    var formationEtGroupe = h2.split(' | ');
    var formation = formationEtGroupe[0];
    if(list1.value != "" && list2.value != "") {
      var subtitle = h2;
    } else if (list1.value != "" && list2.value == "") {
      var subtitle = formation;
    } else {
      var subtitle = "";
    }
   
    var subtitleWidth = doc.getStringUnitWidth(subtitle) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    var subtitleX = (pageWidth - subtitleWidth) / 2;
    doc.text(subtitle, subtitleX, 30);

    // Ajout du logo en haut à droite
    doc.addImage(dataURL, 'PNG', doc.internal.pageSize.width - 55, 3, 50, 25);
    

    for (var i = 0; i < filteredDivs.length; i++) {
      var div = filteredDivs[i];

      var name = div.querySelector('.etu').innerText;
      var mail = div.querySelector('.etu_mail').innerText;

      console.log(name);
      console.log(mail);

      if (counter % itemsPerRow === 0 && counter !== 0) {
        x = 30;
        y = y + 70;
      }

      if (y >= pageHeight - 30) {
        doc.addPage();
        y = 20;
        // Ajout du logo en haut à droite
        doc.addImage(dataURL, 'PNG', doc.internal.pageSize.width - 55, 3, 50, 25);
      }

      doc.setFont("helvetica", "bold");
      doc.setTextColor(0, 0, 0);
      doc.setFontSize(12);
      doc.text(x, y + 10, name);
    
      doc.setFont("times", "normal");
      doc.setTextColor(68, 104, 111);
      doc.setFontSize(12);
      doc.text(x, y + 20, mail);

      x = x + (pageWidth - 40) / itemsPerRow;
      counter++;

      //pagination
      var pageInfo = doc.internal.getCurrentPageInfo();
      var pageNumber = pageInfo.pageNumber;
      
      doc.setFont("helvetica", "normal");
      doc.setTextColor(0, 0, 0);
      doc.setFontSize(12);
      var pageNumberText = pageNumber.toString();
      var pageNumberWidth = doc.getStringUnitWidth(pageNumberText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
      var pageNumberX = (pageWidth - pageNumberWidth) / 2;
      doc.text(pageNumberText, pageNumberX, pageHeight - 10);
      

    }

    doc.save("Trombinoscope.pdf");
  };

}


// function generatePDF() {
//   var doc = new jsPDF({
//     orientation: 'landscape'
//   });

//   var pageWidth = doc.internal.pageSize.width;
  
//   doc.setFont("helvetica", "bold");
//   doc.setFontSize(22);
//   var title = "Trombinoscope";
//   var titleWidth = doc.getStringUnitWidth(title) * doc.internal.getFontSize() / doc.internal.scaleFactor;
//   var titleX = (pageWidth - titleWidth) / 2;
//   doc.text(title, titleX, 20); 

//   doc.setFont("Raleway", "bold");
//   doc.setTextColor(23, 162, 184);
//   doc.setFontSize(16);
//   var subtitle = "Promo X & Groupe X";
//   var subtitleWidth = doc.getStringUnitWidth(subtitle) * doc.internal.getFontSize() / doc.internal.scaleFactor;
//   var subtitleX = (pageWidth - subtitleWidth) / 2;
//   doc.text(subtitle, subtitleX, 30);

//   var x = 20;
//   var y = 50;
//   var pageHeight = doc.internal.pageSize.height;
//   var counter = 0;
//   var itemsPerRow = 4;
  
//   for (var i = 0; i < filteredDivs.length; i++) {
//     var div = filteredDivs[i];

//     var name = div.querySelector('.etu').innerText;

//     var mail = div.querySelector('.etu_mail').innerText;

//     console.log(name);
//     console.log(mail);

//     if (counter % itemsPerRow === 0 && counter !== 0) {
//       x = 20;
//       y = y + 70;
//     }

//     if (y >= pageHeight - 30) {
//       doc.addPage();
//       y = 20;
//     }

//     doc.setFont("helvetica", "bold");
//     doc.setTextColor(0, 0, 0);
//     doc.text(x, y + 10, name);
//     doc.setFont("courier", "normal");
//     doc.setTextColor(68, 104, 111);
//     doc.text(x, y + 20, mail);

//     x = x + (pageWidth - 40) / itemsPerRow;
//     counter++;
//   }

//   doc.save("Trombinoscope.pdf");
// }


// function generatePDF() {
//   var doc = new jsPDF({
//     orientation: 'landscape'
//   });

//   doc.setFont("helvetica", "bold");
//   doc.setFontSize(22);
//   var title = "Trombinoscope";
//   var x = (pageWidth - doc.getStringUnitWidth(title) * doc.internal.getFontSize()) / 2;
//   doc.text(title, x, 20); 

//   doc.setFont("Raleway", "bold");
//   doc.setTextColor(23, 162, 184);
//   doc.setFontSize(16);
//   var subtitle = "Promo X & Groupe X";
//   x = (pageWidth - doc.getStringUnitWidth(subtitle) * doc.internal.getFontSize()) / 2;
//   doc.text(subtitle, x, 30);

//   var x = 20;
//   var y = 50;
//   var pageHeight = doc.internal.pageSize.height;
//   var pageWidth = doc.internal.pageSize.width;
//   var counter = 0;
//   var itemsPerRow = 4;
  
//   for (var i = 0; i < filteredDivs.length; i++) {
//     var div = filteredDivs[i];

//     var name = div.querySelector('.etu').innerText;
  
//     // var h2 = div.querySelector('.etu_pr').innerText;
//     // var formationEtGroupe = h2.split(' | ');
//     // var formation = formationEtGroupe[0];
//     // var groupe = formationEtGroupe[1];

//     // var image = div.querySelector('img').getAttribute('src');

//     var mail = div.querySelector('.etu_mail').innerText;

//     console.log(name);
//     // console.log(image);
//     // console.log(formation);
//     // console.log(groupe);
//     console.log(mail);

//     if (counter % itemsPerRow === 0 && counter !== 0) {
//       x = 20;
//       y = y + 70;
//     }

//     if (y >= pageHeight - 30) {
//       doc.addPage();
//       y = 20;
//     }

//     // doc.addImage(image, 'JPEG', x, y, 40, 40);
//     doc.setFont("helvetica", "bold");
//     doc.setTextColor(0, 0, 0);
//     doc.text(x, y + 10, name);
//     // doc.text(x, y + 20, formation);
//     // doc.text(x, y + 30, groupe);
//     doc.setFont("courier", "normal");
//     doc.setTextColor(68, 104, 111);
//     doc.text(x, y + 20, mail);

//     x = x + (pageWidth - 40) / itemsPerRow;
//     counter++;
//   }

//   doc.save("Trombinoscope.pdf");
// }


  
  // var studentData = [  {    name: "John Doe",    photo: "john_doe.jpg",    information: "John est un étudiant en informatique."  },
  //                   {    name: "Jane Doe",    photo: "jane_doe.jpg",    information: "Jane est une étudiante en mathématiques."  }];

  // studentData.forEach(function(student) {
  //   doc.setFontSize(18);
  //   doc.text(student.name, 10, 10);
    
  //   // Charger l'image en utilisant un objet Image
  //   // var image = new Image();
  //   // image.src = "images/1.jpg";
  //   // image.onload = function() {
  //   //   // Encoder l'image en base64
  //   //   var imgData = image.toDataURL('image/jpeg');
  //   //   // Ajouter l'image au document PDF
  //   //   doc.addImage(imgData, 'JPEG', 10, 20, 50, 50);
  //   // };

  //   var reader = new File("images/1.jpg");
  //   reader.onload = function() {
  //     var imgData = reader.result;
  //     doc.addImage(imgData, 'JPEG', 10, 20, 50, 50);
  //   };
  
  //   doc.setFontSize(12);
  //   doc.text(student.information, 10, 80);
    
  //   // Aller à la page suivante
  //   // doc.addPage();
  // });


// function generatePDF() {
//   var doc = new jsPDF();

//   doc.text(20, 20, 'Hello world');
//   doc.text(20, 30, 'ceci est un test JS pour la génération de pdf');

//   // ajouter une nouvelle page
//   doc.addPage();
//   doc.text(20, 20, 'Hello world222');
//   doc.text(20, 30, 'ceci est un test JS pour la génération de pdf222');

//   // sauvegarder le pdf
//   doc.save('Trombinoscope.pdf');
// }


// // en paysage
// function generatePDF_2() {
//   var doc = new jsPDF({
//     orientation: 'landscape'
//   });

//   doc.text(20, 20, 'Hello world');
//   doc.text(20, 30, 'ceci est un test JS pour la génération de pdf');

//   // ajouter une nouvelle page
//   doc.addPage();
//   doc.text(20, 20, 'Hello world222');
//   doc.text(20, 30, 'ceci est un test JS pour la génération de pdf222');

//   // sauvegarder le pdf
//   doc.save('Trombinoscope.pdf');
// }

// // les fonts
// function generatePDF_3() {
//   var doc = new jsPDF();
	
//   doc.text(20, 20, 'This is the default font.');

//   doc.setFont("courier", "normal");
//   doc.text("This is courier normal.", 20, 30);

//   doc.setFont("times", "italic");
//   doc.text("This is times italic.", 20, 40);

//   doc.setFont("helvetica", "bold");
//   doc.text("This is helvetica bold.", 20, 50);

//   doc.setFont("courier", "bolditalic");
//   doc.text("This is courier bolditalic.", 20, 60);

//   doc.setFont("times", "normal");
//   doc.text("This is centred text.", 105, 80, null, null, "center");
//   doc.text("And a little bit more underneath it.", 105, 90, null, null, "center");
//   doc.text("This is right aligned text", 200, 100, null, null, "right");
//   doc.text("And some more", 200, 110, null, null, "right");
//   doc.text("Back to left", 20, 120);

//   doc.text("10 degrees rotated", 20, 140, null, 10);
//   doc.text("-10 degrees rotated", 20, 160, null, -10);

//   // Save the PDF
//   doc.save('Trombinoscope.pdf');
// }

//titre et sous titre
// function generatePDF() {
//   var doc = new jsPDF();
	
//   doc.setFontSize(24);
//   doc.text("Trombinoscope", 20, 20);

  

//   // Save the PDF
//   doc.save('Trombinoscope.pdf');
// }


// couleurs
// function generatePDF_5() {
//   var doc = new jsPDF();
	
//   doc.setTextColor(100);
//   doc.text("This is gray", 20, 20);

//   doc.setTextColor(150);
//   doc.text("This is light gray", 20, 30);

//   doc.setTextColor(255, 0, 0);
//   doc.text("This is red", 20, 40);

//   doc.setTextColor(0, 255, 0);
//   doc.text("This is green", 20, 50);

//   doc.setTextColor(0, 0, 255);
//   doc.text("This is blue", 20, 60);

//   doc.setTextColor("red");
//   doc.text("This is red", 60, 40);

//   doc.setTextColor("green");
//   doc.text("This is green", 60, 50);

//   doc.setTextColor("blue");
//   doc.text("This is blue", 60, 60);

//   // Save the PDF
//   doc.save('Trombinoscope.pdf');
// }


//ajout image
// function generatePDF_6() {
//   var doc = new jsPDF();
	
//   doc.setFontSize(24);
//   doc.text("this is a title", 20, 20);

//   doc.setFontSize(16);
//   doc.text("This is some normal sised text underneath", 20, 30);

//   doc.addImage("images/1.jpg", "JPEG", 15, 40, 180, 180);

//   // Save the PDF
//   doc.save('Trombinoscope.pdf');

// }

// function generatePDF_6() {
//   var image = new Image();
//   image.src = "images/1.jpg";

//   image.onload = function() {
//     var canvas = document.createElement("canvas");
//     canvas.width = image.width;
//     canvas.height = image.height;
    
//     var ctx = canvas.getContext("2d");
//     ctx.drawImage(image, 0, 0);
    
//     var base64 = canvas.toDataURL("image/jpeg");

//     var doc = new jsPDF();
    
//     doc.setFontSize(24);
//     doc.text("this is a title", 20, 20);
    
//     doc.setFontSize(16);
//     doc.text("This is some normal sised text underneath", 20, 30);
    
//     doc.addImage(base64, "JPEG", 15, 40, 180, 180);
    
//     doc.save('Trombinoscope.pdf');
//   };
// }

// // Convert HTML content to PDF
// function Convert_HTML_To_PDF() {
//   var doc = new jsPDF();

//   // Source HTMLElement or a string containing HTML.
//   var elementHTML = document.querySelector("#contentToPrint");

//   doc.html(elementHTML, {
//       callback: function(doc) {
//           // Save the PDF
//           doc.save('Trombinoscope.pdf');
//       },
//       margin: [10, 10, 10, 10],
//       autoPaging: 'text',
//       x: 0,
//       y: 0,
//       width: 190, //target width in the PDF document
//       windowWidth: 675 //window width in CSS pixels
//   });
// }