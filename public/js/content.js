//Content
var text = 1;
var image = 1;

$("#text").click(function(){
    if (text < 11) {
        if (!(text > image)) {
            var newDiv = document.createElement("div");
            newDiv.className = "form-group";
            var label = document.createElement("label");
            label.setAttribute("class", "my-2");
            label.setAttribute("for", "content"+text);
            var span = document.createElement("span");
            span.setAttribute("class", "FieldInfo");
            span.innerText = "İçerik Metni:";
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("id", "content"+text);
            input.setAttribute("name", "text"+text);
            var trix = document.createElement("trix-editor");
            trix.setAttribute("class", "trix-editor");
            trix.setAttribute("input", "content"+text);
            label.appendChild(span);
            newDiv.appendChild(input);
            newDiv.appendChild(trix);
            document.getElementById("list").appendChild(label);
            document.getElementById("list").appendChild(newDiv);
            text++;
            document.getElementById('text').scrollIntoView()
            console.log(text);
            console.log(image);
        } else {
            alert("Arka arkaya iki tane metin kutucuğu ekleyemezsin!");
        }
    } else {
        alert("En fazla 10 tane metin kutucuğu ekleyebilirsin.")
    }

});
$("#image").click(function(){
    if (image < 11) {
        if (image !== text || image < text) {
            var newDiv = document.createElement("div");
            newDiv.className = "custom-file";
            var label = document.createElement("label");
            label.setAttribute("class", "custom-file-label");
            label.setAttribute("for", "customFile"+image);
            label.innerText = "Fotoğraf Seç"
            var input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("name", "image"+image);
            input.setAttribute("class", "custom-file-input");
            input.setAttribute("id", "customFile"+image);
            newDiv.appendChild(input);
            newDiv.appendChild(label);
            document.getElementById("list").appendChild(newDiv);
            image++;
            document.getElementById('image').scrollIntoView()
        } else {
            alert("Arka arkaya iki tane görsel ekleyemezsin!")
        }
    } else {
        alert("En fazla 10 tane görsel ekleyebilirsin.");
    }
});

$(document).ready(function(){
    $('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
    );
});


