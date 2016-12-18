/**
 * ABRIR UNA VENTANA CENTRADA
 * @param {Object} theURL
 * @param {Object} winName
 * @param {Object} features
 * @param {Object} myWidth
 * @param {Object} myHeight
 * @param {Object} isCenter
 */

function OpenBrWindow(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
  var feature = '';
   
  if(window.screen)
  if(isCenter)
  if(isCenter==true){
    var myLeft = (screen.width-myWidth)/2;
    var myTop = (screen.height-myHeight)/2;
    feature =(features!='')?',':'';
    feature+='left='+myLeft+',top='+myTop+',';
  }
 
  window.open(theURL,winName,features+feature+'width='+myWidth+',height='+myHeight+',location=1,scrollbars=1');
}