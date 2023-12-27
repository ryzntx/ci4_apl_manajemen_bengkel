/**
 * Highstock JS v11.2.0 (2023-10-30)
 *
 * Indicator series type for Highstock
 *
 * (c) 2010-2021 Rafal Sebestjanski
 *
 * License: www.highcharts.com/license
 */!function(e){"object"==typeof module&&module.exports?(e.default=e,module.exports=e):"function"==typeof define&&define.amd?define("highcharts/indicators/disparity-index",["highcharts","highcharts/modules/stock"],function(t){return e(t),e.Highcharts=t,e}):e("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(e){"use strict";var t=e?e._modules:{};function i(e,t,i,a){e.hasOwnProperty(t)||(e[t]=a.apply(null,i),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:t,module:e[t]}})))}i(t,"Stock/Indicators/DisparityIndex/DisparityIndexIndicator.js",[t["Core/Series/SeriesRegistry.js"],t["Core/Utilities.js"]],function(e,t){let{sma:i}=e.seriesTypes,{correctFloat:a,defined:s,extend:r,isArray:n,merge:o}=t;class d extends i{constructor(){super(...arguments),this.averageIndicator=void 0,this.data=void 0,this.options=void 0,this.points=void 0}init(){let t=arguments,a=t[1].params,s=a&&a.average?a.average:void 0;this.averageIndicator=e.seriesTypes[s]||i,this.averageIndicator.prototype.init.apply(this,t)}calculateDisparityIndex(e,t){return a(e-t)/t*100}getValues(e,t){let i=t.index,a=e.xData,r=e.yData,o=r?r.length:0,d=[],p=[],u=[],c=this.averageIndicator,h=n(r[0]),l=c.prototype.getValues(e,t),y=l.yData,g=a.indexOf(l.xData[0]);if(y&&0!==y.length&&s(i)&&!(r.length<=g)){for(let e=g;e<o;e++){let t=this.calculateDisparityIndex(h?r[e][i]:r[e],y[e-g]);d.push([a[e],t]),p.push(a[e]),u.push(t)}return{values:d,xData:p,yData:u}}}}return d.defaultOptions=o(i.defaultOptions,{params:{average:"sma",index:3},marker:{enabled:!1},dataGrouping:{approximation:"averages"}}),r(d.prototype,{nameBase:"Disparity Index",nameComponents:["period","average"]}),e.registerSeriesType("disparityindex",d),d}),i(t,"masters/indicators/disparity-index.src.js",[],function(){})});//# sourceMappingURL=disparity-index.js.map