/**
 * Highstock JS v11.2.0 (2023-10-30)
 *
 * Indicator series type for Highcharts Stock
 *
 * (c) 2010-2021 Rafal Sebestjanski
 *
 * License: www.highcharts.com/license
 */!function(e){"object"==typeof module&&module.exports?(e.default=e,module.exports=e):"function"==typeof define&&define.amd?define("highcharts/indicators/tema",["highcharts","highcharts/modules/stock"],function(t){return e(t),e.Highcharts=t,e}):e("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(e){"use strict";var t=e?e._modules:{};function l(e,t,l,i){e.hasOwnProperty(t)||(e[t]=i.apply(null,l),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:t,module:e[t]}})))}l(t,"Stock/Indicators/TEMA/TEMAIndicator.js",[t["Core/Series/SeriesRegistry.js"],t["Core/Utilities.js"]],function(e,t){let{ema:l}=e.seriesTypes,{correctFloat:i,isArray:s,merge:o}=t;class n extends l{constructor(){super(...arguments),this.EMApercent=void 0,this.data=void 0,this.options=void 0,this.points=void 0}getEMA(e,t,l,i,s,o){return super.calculateEma(o||[],e,void 0===s?1:s,this.EMApercent,t,void 0===i?-1:i,l)}getTemaPoint(e,t,l,s){let o=[e[s-3],i(3*l.level1-3*l.level2+l.level3)];return o}getValues(e,t){let l=t.period,i=2*l,o=3*l,n=e.xData,r=e.yData,a=r?r.length:0,u=[],d=[],h=[],v=[],c=[],p={},f=-1,g=0,m=0,E,y,M,A;if(this.EMApercent=2/(l+1),!(a<3*l-2)){for(s(r[0])&&(f=t.index?t.index:0),m=(g=super.accumulatePeriodPoints(l,f,r))/l,g=0,M=l;M<a+3;M++)M<a+1&&(p.level1=this.getEMA(r,E,m,f,M)[1],v.push(p.level1)),E=p.level1,M<i?g+=p.level1:(M===i&&(m=g/l,g=0),p.level1=v[M-l-1],p.level2=this.getEMA([p.level1],y,m)[1],c.push(p.level2),y=p.level2,M<o?g+=p.level2:(M===o&&(m=g/l),M===a+1&&(p.level1=v[M-l-1],p.level2=this.getEMA([p.level1],y,m)[1],c.push(p.level2)),p.level1=v[M-l-2],p.level2=c[M-2*l-1],p.level3=this.getEMA([p.level2],p.prevLevel3,m)[1],(A=this.getTemaPoint(n,o,p,M))&&(u.push(A),d.push(A[0]),h.push(A[1])),p.prevLevel3=p.level3));return{values:u,xData:d,yData:h}}}}return n.defaultOptions=o(l.defaultOptions),e.registerSeriesType("tema",n),n}),l(t,"masters/indicators/tema.src.js",[],function(){})});//# sourceMappingURL=tema.js.map