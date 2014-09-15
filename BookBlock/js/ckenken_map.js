function createPage(pageNumber) {

	var bb_item = document.createElement("div");
	bb_item.className = "bb-item";
	
	var bb_custom_side = document.createElement("div");
	bb_custom_side.className = "bb-custom-side";

	var bb_custom_side2 = document.createElement("div");
	bb_custom_side2.className = "bb-custom-side";

	var map = document.createElement("div");
	map.id = "myMap" + pageNumber.toString();	
	map.className = "map";
	map.style.position = "relative";
	map.style.width = "600px";
	map.style.height = "600px";
	map.style.margin = "auto";

	bb_custom_side.appendChild(map);

	var labels = document.createElement("p");
	labels.id = "label" + pageNumber.toString();
	labels.innerHTML = "";  // 12345
 
	var br1 = document.createElement("br");
	var br2 = document.createElement("br");

	var images = document.createElement("p");
	images.id = "label" + pageNumber.toString() + "jpg";

	var img = document.createElement("img");
	var img2 = document.createElement("img");
	var img3 = document.createElement("img");
	
	img.src = "building.jpg";
	img2.src = "building.jpg";
	img3.src = "building.jpg";
	
	img.className="picture";
	img2.className="picture";
	img3.className="picture";
	
	img.alt="building";
	img2.alt="building";
	img3.alt="building";

	img1.name = "picture";
	img2.name = "picture";
	img3.name = "picture";

	bb_custom_side2.appendChild(labels);
//	bb_custom_side2.appendChild(br1);
//	bb_custom_side2.appendChild(br2);

	bb_custom_side2.appendChild(images);

	images.appendChild(img);
	images.appendChild(img2);
	images.appendChild(img3);

	bb_item.appendChild(bb_custom_side);
	bb_item.appendChild(bb_custom_side2);

	var bb_bookblock = document.getElementById("bb-bookblock");

	bb_bookblock.appendChild(bb_item);

//	for(int i = 0; ;)

}
