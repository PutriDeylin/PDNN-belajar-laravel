/**
 * Highcharts JS v11.2.0 (2023-10-30)
 *
 * ColorAxis module
 *
 * (c) 2012-2021 Pawel Potaczek
 *
 * License: www.highcharts.com/license
 */!function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/modules/color-axis",["highcharts"],function(e){return t(e),t.Highcharts=e,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var e=t?t._modules:{};function s(t,e,s,i){t.hasOwnProperty(e)||(t[e]=i.apply(null,s),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:t[e]}})))}s(e,"Core/Axis/Color/ColorAxisComposition.js",[e["Core/Color/Color.js"],e["Core/Utilities.js"]],function(t,e){var s;let{parse:i}=t,{addEvent:o,extend:l,merge:r,pick:a,splat:n}=e;return function(t){let s;let h=[];function d(){let t=this.options;this.colorAxis=[],t.colorAxis&&(t.colorAxis=n(t.colorAxis),t.colorAxis.map(t=>new s(this,t)))}function c(t){let e=this.chart.colorAxis||[],s=e=>{let s=t.allItems.indexOf(e);-1!==s&&(this.destroyItem(t.allItems[s]),t.allItems.splice(s,1))},i=[],o,l;for(e.forEach(function(t){(o=t.options)&&o.showInLegend&&(o.dataClasses&&o.visible?i=i.concat(t.getDataClassLegendSymbols()):o.visible&&i.push(t),t.series.forEach(function(t){(!t.options.showInLegend||o.dataClasses)&&("point"===t.options.legendType?t.points.forEach(function(t){s(t)}):s(t))}))}),l=i.length;l--;)t.allItems.unshift(i[l])}function p(t){t.visible&&t.item.legendColor&&t.item.legendItem.symbol.attr({fill:t.item.legendColor})}function f(t){this.chart.colorAxis?.forEach(e=>{e.update({},t.redraw)})}function u(){(this.chart.colorAxis&&this.chart.colorAxis.length||this.colorAttribs)&&this.translateColors()}function g(){let t=this.axisTypes;t?-1===t.indexOf("colorAxis")&&t.push("colorAxis"):this.axisTypes=["colorAxis"]}function m(t){let e=this,s=t?"show":"hide";e.visible=e.options.visible=!!t,["graphic","dataLabel"].forEach(function(t){e[t]&&e[t][s]()}),this.series.buildKDTree()}function x(){let t=this,e=this.data.length?this.data:this.points,s=this.options.nullColor,i=this.colorAxis,o=this.colorKey;e.forEach(e=>{let l=e.getNestedProperty(o),r=e.options.color||(e.isNull||null===e.value?s:i&&void 0!==l?i.toColor(l,e):e.color||t.color);r&&e.color!==r&&(e.color=r,"point"===t.options.legendType&&e.legendItem&&e.legendItem.label&&t.chart.legend.colorizeItem(e,e.visible))})}function C(){this.elem.attr("fill",i(this.start).tweenTo(i(this.end),this.pos),void 0,!0)}function y(){this.elem.attr("stroke",i(this.start).tweenTo(i(this.end),this.pos),void 0,!0)}t.compose=function(t,i,n,b,A){if(s||(s=t),e.pushUnique(h,i)){let t=i.prototype;t.collectionsWithUpdate.push("colorAxis"),t.collectionsWithInit.colorAxis=[t.addColorAxis],o(i,"afterGetAxes",d),function(t){let e=t.prototype.createAxis;t.prototype.createAxis=function(t,i){if("colorAxis"!==t)return e.apply(this,arguments);let o=new s(this,r(i.axis,{index:this[t].length,isX:!1}));return this.isDirtyLegend=!0,this.axes.forEach(t=>{t.series=[]}),this.series.forEach(t=>{t.bindAxes(),t.isDirtyData=!0}),a(i.redraw,!0)&&this.redraw(i.animation),o}}(i)}if(e.pushUnique(h,n)){let t=n.prototype;t.fillSetter=C,t.strokeSetter=y}e.pushUnique(h,b)&&(o(b,"afterGetAllItems",c),o(b,"afterColorizeItem",p),o(b,"afterUpdate",f)),e.pushUnique(h,A)&&(l(A.prototype,{optionalAxis:"colorAxis",translateColors:x}),l(A.prototype.pointClass.prototype,{setVisible:m}),o(A,"afterTranslate",u,{order:1}),o(A,"bindAxes",g))},t.pointSetVisible=m}(s||(s={})),s}),s(e,"Core/Axis/Color/ColorAxisDefaults.js",[],function(){return{lineWidth:0,minPadding:0,maxPadding:0,gridLineColor:"#ffffff",gridLineWidth:1,tickPixelInterval:72,startOnTick:!0,endOnTick:!0,offset:0,marker:{animation:{duration:50},width:.01,color:"#999999"},labels:{distance:8,overflow:"justify",rotation:0},minColor:"#e6e9ff",maxColor:"#0022ff",tickLength:5,showInLegend:!0}}),s(e,"Core/Axis/Color/ColorAxisLike.js",[e["Core/Color/Color.js"],e["Core/Utilities.js"]],function(t,e){var s,i;let{parse:o}=t,{merge:l}=e;return(i=s||(s={})).initDataClasses=function(t){let e=this.chart,s=this.legendItem=this.legendItem||{},i=this.options,r=t.dataClasses||[],a,n,h=e.options.chart.colorCount,d=0,c;this.dataClasses=n=[],s.labels=[];for(let t=0,s=r.length;t<s;++t)a=l(a=r[t]),n.push(a),(e.styledMode||!a.color)&&("category"===i.dataClassColor?(e.styledMode||(h=(c=e.options.colors||[]).length,a.color=c[d]),a.colorIndex=d,++d===h&&(d=0)):a.color=o(i.minColor).tweenTo(o(i.maxColor),s<2?.5:t/(s-1)))},i.initStops=function(){let t=this.options,e=this.stops=t.stops||[[0,t.minColor||""],[1,t.maxColor||""]];for(let t=0,s=e.length;t<s;++t)e[t].color=o(e[t][1])},i.normalizedValue=function(t){let e=this.max||0,s=this.min||0;return this.logarithmic&&(t=this.logarithmic.log2lin(t)),1-(e-t)/(e-s||1)},i.toColor=function(t,e){let s,i,o,l,r,a;let n=this.dataClasses,h=this.stops;if(n){for(a=n.length;a--;)if(i=(r=n[a]).from,o=r.to,(void 0===i||t>=i)&&(void 0===o||t<=o)){l=r.color,e&&(e.dataClass=a,e.colorIndex=r.colorIndex);break}}else{for(s=this.normalizedValue(t),a=h.length;a--&&!(s>h[a][0]););i=h[a]||h[a+1],s=1-((o=h[a+1]||i)[0]-s)/(o[0]-i[0]||1),l=i.color.tweenTo(o.color,s)}return l},s}),s(e,"Core/Axis/Color/ColorAxis.js",[e["Core/Axis/Axis.js"],e["Core/Axis/Color/ColorAxisComposition.js"],e["Core/Axis/Color/ColorAxisDefaults.js"],e["Core/Axis/Color/ColorAxisLike.js"],e["Core/Legend/LegendSymbol.js"],e["Core/Series/SeriesRegistry.js"],e["Core/Utilities.js"]],function(t,e,s,i,o,l,r){let{series:a}=l,{extend:n,fireEvent:h,isArray:d,isNumber:c,merge:p,pick:f}=r;class u extends t{static compose(t,s,i,o){e.compose(u,t,s,i,o)}constructor(t,e){super(t,e),this.beforePadding=!1,this.chart=void 0,this.coll="colorAxis",this.dataClasses=void 0,this.options=void 0,this.stops=void 0,this.visible=!0,this.init(t,e)}init(t,e){let s=t.options.legend||{},i=e.layout?"vertical"!==e.layout:"vertical"!==s.layout,o=e.visible,l=p(u.defaultColorAxisOptions,e,{showEmpty:!1,title:null,visible:s.enabled&&!1!==o});this.side=e.side||i?2:1,this.reversed=e.reversed||!i,this.opposite=!i,super.init(t,l,"colorAxis"),this.userOptions=e,d(t.userOptions.colorAxis)&&(t.userOptions.colorAxis[this.index]=e),e.dataClasses&&this.initDataClasses(e),this.initStops(),this.horiz=i,this.zoomEnabled=!1}hasData(){return!!(this.tickPositions||[]).length}setTickPositions(){if(!this.dataClasses)return super.setTickPositions()}setOptions(t){super.setOptions(t),this.options.crosshair=this.options.marker}setAxisSize(){let t,e,s,i;let o=this.legendItem&&this.legendItem.symbol,l=this.chart,r=l.options.legend||{};o?(this.left=t=o.attr("x"),this.top=e=o.attr("y"),this.width=s=o.attr("width"),this.height=i=o.attr("height"),this.right=l.chartWidth-t-s,this.bottom=l.chartHeight-e-i,this.len=this.horiz?s:i,this.pos=this.horiz?t:e):this.len=(this.horiz?r.symbolWidth:r.symbolHeight)||u.defaultLegendLength}getOffset(){let t=this.legendItem&&this.legendItem.group,e=this.chart.axisOffset[this.side];if(t){this.axisParent=t,super.getOffset();let s=this.chart.legend;s.allItems.forEach(function(t){t instanceof u&&t.drawLegendSymbol(s,t)}),s.render(),this.chart.getMargins(!0),this.added||(this.added=!0,this.labelLeft=0,this.labelRight=this.width),this.chart.axisOffset[this.side]=e}}setLegendColor(){let t=this.horiz,e=this.reversed,s=e?1:0,i=e?0:1,o=t?[s,0,i,0]:[0,i,0,s];this.legendColor={linearGradient:{x1:o[0],y1:o[1],x2:o[2],y2:o[3]},stops:this.stops}}drawLegendSymbol(t,e){let s=e.legendItem||{},i=t.padding,o=t.options,l=this.options.labels,r=f(o.itemDistance,10),a=this.horiz,n=f(o.symbolWidth,a?u.defaultLegendLength:12),h=f(o.symbolHeight,a?12:u.defaultLegendLength),d=f(o.labelPadding,a?16:30);this.setLegendColor(),s.symbol||(s.symbol=this.chart.renderer.symbol("roundedRect",0,t.baseline-11,n,h,{r:o.symbolRadius??3}).attr({zIndex:1}).add(s.group)),s.labelWidth=n+i+(a?r:f(l.x,l.distance)+this.maxLabelLength),s.labelHeight=h+i+(a?d:0)}setState(t){this.series.forEach(function(e){e.setState(t)})}setVisible(){}getSeriesExtremes(){let t=this.series,e,s,i,o,l,r,n=t.length,h,d;for(this.dataMin=1/0,this.dataMax=-1/0;n--;){if(s=(r=t[n]).colorKey=f(r.options.colorKey,r.colorKey,r.pointValKey,r.zoneAxis,"y"),o=r.pointArrayMap,l=r[s+"Min"]&&r[s+"Max"],r[s+"Data"])e=r[s+"Data"];else if(o){if(e=[],i=o.indexOf(s),h=r.yData,i>=0&&h)for(d=0;d<h.length;d++)e.push(f(h[d][i],h[d]))}else e=r.yData;if(l)r.minColorValue=r[s+"Min"],r.maxColorValue=r[s+"Max"];else{let t=a.prototype.getExtremes.call(r,e);r.minColorValue=t.dataMin,r.maxColorValue=t.dataMax}void 0!==r.minColorValue&&(this.dataMin=Math.min(this.dataMin,r.minColorValue),this.dataMax=Math.max(this.dataMax,r.maxColorValue)),l||a.prototype.applyExtremes.call(r)}}drawCrosshair(t,e){let s;let i=this.legendItem||{},o=e&&e.plotX,l=e&&e.plotY,r=this.pos,a=this.len;e&&((s=this.toPixels(e.getNestedProperty(e.series.colorKey)))<r?s=r-2:s>r+a&&(s=r+a+2),e.plotX=s,e.plotY=this.len-s,super.drawCrosshair(t,e),e.plotX=o,e.plotY=l,this.cross&&!this.cross.addedToColorAxis&&i.group&&(this.cross.addClass("highcharts-coloraxis-marker").add(i.group),this.cross.addedToColorAxis=!0,this.chart.styledMode||"object"!=typeof this.crosshair||this.cross.attr({fill:this.crosshair.color})))}getPlotLinePath(t){let e=this.left,s=t.translatedValue,i=this.top;return c(s)?this.horiz?[["M",s-4,i-6],["L",s+4,i-6],["L",s,i],["Z"]]:[["M",e,s],["L",e-6,s+6],["L",e-6,s-6],["Z"]]:super.getPlotLinePath(t)}update(t,e){let s=this.chart,i=s.legend;this.series.forEach(t=>{t.isDirtyData=!0}),(t.dataClasses&&i.allItems||this.dataClasses)&&this.destroyItems(),super.update(t,e),this.legendItem&&this.legendItem.label&&(this.setLegendColor(),i.colorizeItem(this,!0))}destroyItems(){let t=this.chart,e=this.legendItem||{};if(e.label)t.legend.destroyItem(this);else if(e.labels)for(let s of e.labels)t.legend.destroyItem(s);t.isDirtyLegend=!0}destroy(){this.chart.isDirtyLegend=!0,this.destroyItems(),super.destroy(...[].slice.call(arguments))}remove(t){this.destroyItems(),super.remove(t)}getDataClassLegendSymbols(){let t;let e=this,s=e.chart,i=e.legendItem&&e.legendItem.labels||[],l=s.options.legend,r=f(l.valueDecimals,-1),a=f(l.valueSuffix,""),d=t=>e.series.reduce((e,s)=>(e.push(...s.points.filter(e=>e.dataClass===t)),e),[]);return i.length||e.dataClasses.forEach((l,c)=>{let p=l.from,f=l.to,{numberFormatter:u}=s,g=!0;t="",void 0===p?t="< ":void 0===f&&(t="> "),void 0!==p&&(t+=u(p,r)+a),void 0!==p&&void 0!==f&&(t+=" - "),void 0!==f&&(t+=u(f,r)+a),i.push(n({chart:s,name:t,options:{},drawLegendSymbol:o.rectangle,visible:!0,isDataClass:!0,setState:t=>{for(let e of d(c))e.setState(t)},setVisible:function(){this.visible=g=e.visible=!g;let t=[];for(let e of d(c))e.setVisible(g),-1===t.indexOf(e.series)&&t.push(e.series);s.legend.colorizeItem(this,g),t.forEach(t=>{h(t,"afterDataClassLegendClick")})}},l))}),i}}return u.defaultColorAxisOptions=s,u.defaultLegendLength=200,u.keepProps=["legendItem"],n(u.prototype,i),Array.prototype.push.apply(t.keepProps,u.keepProps),u}),s(e,"masters/modules/coloraxis.src.js",[e["Core/Globals.js"],e["Core/Axis/Color/ColorAxis.js"]],function(t,e){t.ColorAxis=e,e.compose(t.Chart,t.Fx,t.Legend,t.Series)})});//# sourceMappingURL=coloraxis.js.map