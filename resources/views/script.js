let ws = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin');
    let stockPriceElement = document.getElementById('bitcoin-price');
    let lastPrice = null;
let ws2 = new WebSocket('wss://ws.coincap.io/prices?assets=ethereum');
    let ethPriceElement = document.getElementById('ethereum-price');
    let ethlastPrice = null;
let ws3 = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-cash');
    let bchPriceElement = document.getElementById('bch-price');
    let bchlastPrice = null;
let ws4 = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-sv');
    let bsvPriceElement = document.getElementById('bsv-price');
    let bsvlastPrice = null;
let ws5 = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-gold');
    let btgPriceElement = document.getElementById('btg-price');
    let btglastPrice = null;
let ws6 = new WebSocket('wss://ws.coincap.io/prices?assets=litecoin');
    let ltcPriceElement = document.getElementById('ltc-price');
    let ltclastPrice = null;
let ws7 = new WebSocket('wss://ws.coincap.io/prices?assets=binance-coin');
    let bnbPriceElement = document.getElementById('bnb-price');
    let bnblastPrice = null;
let ws8 = new WebSocket('wss://ws.coincap.io/prices?assets=tether');
    let usdtPriceElement = document.getElementById('usdt-price');
    let usdtlPrice = null;
let ws9 = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-bep2');
    let btcbPriceElement = document.getElementById('btcb-price');
    let btcblPrice = null;


ws9.onmessage = (event) => {
    let btcbstockObject = JSON.parse(event.data);
    let btcbprice = btcbstockObject['bitcoin-bep2'];
    btcbPriceElement.innerText = btcbprice;
    btcbPriceElement.style.color = !btcblastPrice ||btcblastPrice === btcbprice ? 'black' : btcbprice > btcblastPrice ? 'green':'red';
    //console.log(bchstockObject);
    
    
    btcblastPrice = btcbprice;
};


ws8.onmessage = (event) => {
    let usdtstockObject = JSON.parse(event.data);
    let usdtprice = "1.00";
    usdtPriceElement.innerText = usdtprice;
    usdtPriceElement.style.color = !usdtlPrice ||usdtlPrice === usdtprice ? 'black' : usdtprice > usdtlPrice ? 'green':'red';
    //console.log(usdtPriceElement);
    
    
    usdtlPrice = usdtprice;
};
ws.onmessage = (event) => {
    let stockObject = JSON.parse(event.data);
    let price = parseFloat(stockObject.bitcoin).toFixed(2);
    stockPriceElement.innerText = price;
    stockPriceElement.style.color = !lastPrice ||lastPrice === price ? 'black' : price > lastPrice ? 'green':'red';
    //console.log(stockObject);
    
    
    lastPrice = price;
};
ws2.onmessage = (event) => {
    let ethstockObject = JSON.parse(event.data);
    let ethprice = parseFloat(ethstockObject.ethereum).toFixed(2);
    ethPriceElement.innerText = ethprice;
    ethPriceElement.style.color = !ethlastPrice ||ethlastPrice === ethprice ? 'black' : ethprice > ethlastPrice ? 'green':'red';
    //console.log(ethstockObject);
    
    
    ethlastPrice = ethprice;
};
ws3.onmessage = (event) => {
    let bchstockObject = JSON.parse(event.data);
    let bchprice = bchstockObject['bitcoin-cash'];
    bchPriceElement.innerText = bchprice;
    bchPriceElement.style.color = !bchlastPrice ||bchlastPrice === bchprice ? 'black' : bchprice > bchlastPrice ? 'green':'red';
    //console.log(bchstockObject);
    
    
    bchlastPrice = bchprice;
};

ws4.onmessage = (event) => {
    let bsvstockObject = JSON.parse(event.data);
    let bsvprice = bsvstockObject['bitcoin-sv'];
    bsvPriceElement.innerText = bsvprice;
    bsvPriceElement.style.color = !bsvlastPrice ||bsvlastPrice === bsvprice ? 'black' : bsvprice > bsvlastPrice ? 'green':'red';
    //console.log(bsvstockObject);
    
    
    bsvlastPrice = bsvprice;
};

ws5.onmessage = (event) => {
    let btgstockObject = JSON.parse(event.data);
    let btgprice = btgstockObject['bitcoin-gold'];
    btgPriceElement.innerText = btgprice;
    btgPriceElement.style.color = !btglastPrice ||btglastPrice === btgprice ? 'black' : btgprice > btglastPrice ? 'green':'red';
    //console.log(btgstockObject);
    
    
    btglastPrice = btgprice;
};

ws6.onmessage = (event) => {
    let ltcstockObject = JSON.parse(event.data);
    let ltcprice = ltcstockObject['litecoin'];
    ltcPriceElement.innerText = ltcprice;
    ltcPriceElement.style.color = !ltclastPrice ||ltclastPrice === ltcprice ? 'black' : ltcprice > ltclastPrice ? 'green':'red';
    //console.log(ltcstockObject);
    
    
    ltclastPrice = ltcprice;
};

ws7.onmessage = (event) => {
    let bnbstockObject = JSON.parse(event.data);
    let bnbprice = bnbstockObject['binance-coin'];
    bnbPriceElement.innerText = bnbprice;
    bnbPriceElement.style.color = !bnblastPrice ||bnblastPrice === bnbprice ? 'black' : bnbprice > bnblastPrice ? 'green':'red';
    //console.log(bnbstockObject);
    
    
    bnblastPrice = bnbprice;
};





let coinpricetotal = document.getElementById('cointotal-usd');
var btc = document.getElementById('btc-usd').value;
var eth = document.getElementById('eth-usd');
var bch = document.getElementById('bch-usd');
var bsv = document.getElementById('bsv-usd');
var btg = document.getElementById('btg-usd');
var ltc = document.getElementById('ltc-usd');
var bnb = document.getElementById('bnb-usd');


let pricesWs = new WebSocket('wss://ws.coincap.io/prices?assets=tether');

// pricesWs.onmessage = function (msg) {
//     //console.log('usdt':msg.data)
// }


let wsBtcb = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-bep2');
    //console.log(wsUsdt);
    let btcbusdElement = document.getElementById('btcb-usd');
    let btcblastPrice = null;
    
    
wsBtcb.onmessage = (event) => {
    let btcbstockObject = JSON.parse(event.data);
    let btcbusd = btcbstockObject['bitcoin-bep2'];
    //coin balance
    let btcbbalance = "{{$btcb_balance}}"; 
    let btcbusdPrice = btcbbalance * btcbusd;
    btcbusdElement.innerText = btcbusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    //let nn = bnbusdPrice.toFixed(2);
    //var nn = bnbusdPrice.toFixed(2);
    btcbusdlastPrice = btcbusd;
};



    let wsUsdt = new WebSocket('wss://ws.coincap.io/prices?assets=tether');
    //console.log(wsUsdt);
    let usdtElement = document.getElementById('usdt-usd');
    let usdtlastPrice = null;
    
    
wsUsdt.onmessage = (event) => {
    let usdtstockObject = JSON.parse(event.data);
    let usdt = 1.00;
    let usdtbalance = "{{$usdt_balance}}";
    let usdtPrice = usdtbalance * usdt;
    usdtElement.innerText = usdtPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    usdtlastPrice = usdt;
};
        let wsBnbUsd = new WebSocket('wss://ws.coincap.io/prices?assets=binance-coin');
    let bnbusdpElement = document.getElementById('bnb-usd');
    let bnbusdlastPrice = null;
    
    
wsBnbUsd.onmessage = (event) => {
    let bnbstockObject = JSON.parse(event.data);
    let bnbusd = bnbstockObject['binance-coin'];
    let bnbbalance = "{{$balance}}";
    let bnbusdPrice = bnbbalance * bnbusd;
    bnbusdpElement.innerText = bnbusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    //let nn = bnbusdPrice.toFixed(2);
    //var nn = bnbusdPrice.toFixed(2);
    bnbusdlastPrice = bnbusd;
};




let wsBtcUsd = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin');
    let btcusdpElement = document.getElementById('btc-usd');
    let btcusdlastPrice = null;
    
    
wsBtcUsd.onmessage = (event) => {
    let btcstockObject = JSON.parse(event.data);
    let btcusd = btcstockObject['bitcoin'];
    let btcbalance = "{{$btc_balance}}";
    let btcusdPrice = btcbalance * btcusd;
    btcusdpElement.innerText = btcusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    btcusdlastPrice = btcusd;
};

let wsEthUsd = new WebSocket('wss://ws.coincap.io/prices?assets=ethereum');
    let ethusdpElement = document.getElementById('eth-usd');
    let ethusdlastPrice = null;
    
    
wsEthUsd.onmessage = (event) => {
    let ethstockObject = JSON.parse(event.data);
    let ethusd = ethstockObject['ethereum'];
    let ethbalance = "{{$eth_balance}}";
    let ethusdPrice = ethbalance * ethusd;
    ethusdpElement.innerText = ethusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    ethusdlastPrice = ethusd;
};

let wsBchUsd = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-cash');
    let bchusdpElement = document.getElementById('bch-usd');
    let bchusdlastPrice = null;
    
    
wsBchUsd.onmessage = (event) => {
    let bchstockObject = JSON.parse(event.data);
    let bchusd = bchstockObject['bitcoin-cash'];
    let bchbalance = "{{$bch_balance}}";
    let bchusdPrice = bchbalance * bchusd;
    bchusdpElement.innerText = bchusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    bchusdlastPrice = bchusd;
};

let wsBsvUsd = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-sv');
    let bsvusdpElement = document.getElementById('bsv-usd');
    let bsvusdlastPrice = null;
    
    
wsBsvUsd.onmessage = (event) => {
    let bsvstockObject = JSON.parse(event.data);
    let bsvusd = bsvstockObject['bitcoin-sv'];
    let bsvbalance = "{{$bsv_balance}}";
    let bsvusdPrice = bsvbalance * bsvusd;
    bsvusdpElement.innerText = bsvusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    bsvusdlastPrice = bsvusd;
};

let wsBtgUsd = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin-gold');
    let btgusdpElement = document.getElementById('btg-usd');
    let btgusdlastPrice = null;
    
    
wsBtgUsd.onmessage = (event) => {
    let btgstockObject = JSON.parse(event.data);
    let btgusd = btgstockObject['bitcoin-gold'];
    let btgbalance = "{{$btg_balance}}";
    let btgusdPrice = btgbalance * btgusd;
    btgusdpElement.innerText = btgusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    btgusdlastPrice = btgusd;
};


let wsLtcUsd = new WebSocket('wss://ws.coincap.io/prices?assets=litecoin');
    let ltcusdpElement = document.getElementById('ltc-usd');
    let ltcusdlastPrice = null;
    
    
wsLtcUsd.onmessage = (event) => {
    let ltcstockObject = JSON.parse(event.data);
    let ltcusd = ltcstockObject['litecoin'];
    let ltcbalance = "{{$ltc_balance}}";
    let ltcusdPrice = ltcbalance * ltcusd;
    ltcusdpElement.innerText = ltcusdPrice.toFixed(2);
    //bnbusdPrice.style.color = !bnbusdlastPrice ||bnbusdlastPrice === bnbusd ? 'black' : bnbusd > bnbusdlastPrice ? 'green':'red';
    //console.log(bnbusdPrice);
    
    
    ltcusdlastPrice = ltcusd;
};


    
    




var pbitcoin = document.getElementById('btc-usd');
var peth = document.getElementById('eth-usd');
var pbch = document.getElementById('bch-usd');
var pbsv = document.getElementById('bsv-usd');
var pbtg = document.getElementById('btg-usd');
var pltc = document.getElementById('ltc-usd');
var pbinance = document.getElementById('bnb-usd');
var pusdt = document.getElementById('usdt-usd');
if(window.addEventListener) {
  // Normal browsers
  pbitcoin.addEventListener('DOMSubtreeModified', contentChanged, false);
  peth.addEventListener('DOMSubtreeModified', contentChanged, false);
  pbch.addEventListener('DOMSubtreeModified', contentChanged, false);
  pbsv.addEventListener('DOMSubtreeModified', contentChanged, false);
  pbtg.addEventListener('DOMSubtreeModified', contentChanged, false);
  pltc.addEventListener('DOMSubtreeModified', contentChanged, false);
  pbinance.addEventListener('DOMSubtreeModified', contentChanged, false);
  pusdt.addEventListener('DOMSubtreeModified', contentChanged, false);
} else
  if(window.attachEvent) {
      // IE
      pbitcoin.attachEvent('DOMSubtreeModified', contentChanged);
      peth.attachEvent('DOMSubtreeModified', contentChanged);
      pbch.attachEvent('DOMSubtreeModified', contentChanged);
      pbsv.attachEvent('DOMSubtreeModified', contentChanged);
      pbtg.attachEvent('DOMSubtreeModified', contentChanged);
      pltc.attachEvent('DOMSubtreeModified', contentChanged);
      pbinance.attachEvent('DOMSubtreeModified', contentChanged);
      pusdt.attachEvent('DOMSubtreeModified', contentChanged);
  }

function contentChanged() {
  let bnb = pbinance.innerText;
  let usdt =  pusdt.innerText;
  let mytotal = Number(bnb) + Number(usdt);
  let mtotal = document.getElementById('total-balance');
  mtotal.innerText = mytotal;
  //console.log(mytotal.toFixed(3));
   
    //console.log(pbitcoin.innerText, peth.innerText, pbch.innerText, pbsv.innerText, pbtg.innerText, pltc.innerText, pbinance.innerText);
}