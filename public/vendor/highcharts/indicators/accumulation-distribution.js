/**
 * Highstock JS v11.2.0 (2023-10-30)
 *
 * Indicator series type for Highcharts Stock
 *
 * (c) 2010-2021 Sebastian Bochan
 *
 * License: www.highcharts.com/license
 */!function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/indicators/accumulation-distribution",["highcharts","highcharts/modules/stock"],function(e){return t(e),t.Highcharts=e,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var e=t?t._modules:{};function i(t,e,i,o){t.hasOwnProperty(e)||(t[e]=o.apply(null,i),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:t[e]}})))}i(e,"Stock/Indicators/AD/ADIndicator.js",[e["Core/Series/SeriesRegistry.js"],e["Core/Utilities.js"]],function(t,e){let{sma:i}=t.seriesTypes,{error:o,extend:s,merge:n}=e;class a extends i{constructor(){super(...arguments),this.data=void 0,this.options=void 0,this.points=void 0}static populateAverage(t,e,i,o,s){let n=e[o][1],a=e[o][2],r=e[o][3],u=i[o],c=t[o];return[c,r===n&&r===a||n===a?0:(2*r-a-n)/(n-a)*u]}getValues(t,e){let i,s,n;let r=e.period,u=t.xData,c=t.yData,d=e.volumeSeriesID,l=t.chart.get(d),h=l&&l.yData,p=c?c.length:0,f=[],m=[],g=[];if(!(u.length<=r)||!p||4===c[0].length){if(!l){o("Series "+d+" not found! Check `volumeSeriesID`.",!0,t.chart);return}for(s=r;s<p;s++)i=f.length,n=a.populateAverage(u,c,h,s,r),i>0&&(n[1]+=f[i-1][1]),f.push(n),m.push(n[0]),g.push(n[1]);return{values:f,xData:m,yData:g}}}}return a.defaultOptions=n(i.defaultOptions,{params:{index:void 0,volumeSeriesID:"volume"}}),s(a.prototype,{nameComponents:!1,nameBase:"Accumulation/Distribution"}),t.registerSeriesType("ad",a),a}),i(e,"masters/indicators/accumulation-distribution.src.js",[],function(){})});//# sourceMappingURL=accumulation-distribution.js.map