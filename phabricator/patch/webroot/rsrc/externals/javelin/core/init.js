document.addEventListener('DOMContentLoaded', _ => {

        document.querySelectorAll(".remarkup-code-header").forEach( i => {
                i.addEventListener("click", (ev) => {
                        ev.target.parentNode.querySelector(".remarkup-code").classList.toggle("hide");
                       i.querySelector("i.phui-font-fa").classList.toggle("fa-toggle-off");
                       i.querySelector("i.phui-font-fa").classList.toggle("fa-toggle-on");

                       ev.stopPropagation();
                       ev.preventDefault();
                });
               i.addEventListener("dblclick", (ev) => {
                       ev.stopPropagation();
                       ev.preventDefault();
               });

               var elm = document.createElement("i");
               elm.classList.add("phui-font-fa");
               elm.classList.add("fa-toggle-off");
               elm.style.pointerEvents = "none";
               elm.innerHTML = " ";
               i.prepend(elm);
        });

        document.querySelectorAll(".remarkup-code-header +  .remarkup-code").forEach( i => {
                i.classList.add("hide");
        });
}, false);
window.addEventListener("resize", _ => updateArrow() );
window.addEventListener("load", _ => updateArrow(), false);

var updateArrow = function() {
  document.querySelectorAll(".sz-arrow").forEach( element => {
    element.style.position = "relative";
    element.style.border = "2px solid black";
    element.querySelectorAll(".arrow").forEach( i => i.remove() );

    var off1 = element.getBoundingClientRect();
    var targets = [];

    try {
        document.querySelectorAll(element.dataset.arrowTo).forEach(i => targets.push(i));
    } catch( e ) { console.log("not valid css selector", e); }
    try {
        var query = document.evaluate(element.dataset.arrowTo.replace(/\\'/g, "'"), element, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
        for (let i = 0, length = query.snapshotLength; i < length; ++i) {
            targets.push(query.snapshotItem(i));
        }
    } catch( e ) { console.log("not valid xpath selector", e); }

    console.log(element.dataset.arrowTo, element, targets);
    targets.map( target => {
      console.log(target);
      var off2 = target.getBoundingClientRect();

      var x1 = off1.width/2;
      var y1 = off1.height;

      var x2 = off2.left - off1.left + off2.width/2;
      var y2 = off2.top - off1.top - 1;

      if( off1.top > off2.top ) {
        y1 -= off1.height;
        y2 += off2.height;
      }

      var length = Math.sqrt(((x2-x1) * (x2-x1)) + ((y2-y1) * (y2-y1))) - 6;
      var angle = Math.atan2((y2-y1),(x2-x1))*(180/Math.PI);

      var cx = x1;
      var cy = y1;

      var htmlLine = "<div class='arrow' style='left:" + cx + "px; top:" + cy + "px; width:" + length + "px; transform:rotate(" + angle + "deg);'><i>►</i></div>";
      element.innerHTML += htmlLine;
    });
  });
}
