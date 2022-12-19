// Instantiating the chart:
var root = am5.Root.new("chartdiv");
var chart = root.container.children.push(
    am5percent.PieChart.new(root, {})
);

// // Hide the amCharts logo
// if (chart.logo) {
//     chart.logo.disabled = true;
// }
// chart.logo.disabled = true;
// Adding series. Pie chart supports one series type: PieSeries
var myseries = chart.series.push(
    am5percent.PieSeries.new(root, {
        name: "Series",
        categoryField: "country",
        valueField: "students",
    })
);

// Hiding tooltips:
myseries.slices.template.setAll({ tooltipText: "" })

// set themes:
root.setThemes([
    am5themes_Animated.new(root)
]);

// animation
myseries.animate({
    key: "startAngle",
    from: 270,
    to: 630,
    loops: 1,
    duration: 2000,
    easing: am5.ease.inOut(am5.ease.cubic) // linear (Constant speed during all duration) - circle - cubic elastic - ...
});

// Colors: Wherever you need to specify a color in amCharts 5 you need to pass in a Color object.
/* A color set comes with a pre-defined list of colors, depending on the theme we are using (if any).

There is a number of ways to override the list as needed.

The most easiest way is to simply set its colors setting to an array of Color objects as done below. Another option is to modify default theme.
*/
// myseries.set("fill", am5.color('#ff0000'));
chart.set("colors", [
    am5.color(0x239923),
    am5.color(0x239923),
    am5.color(0x239923),
    am5.color(0x239923),
    am5.color(0x239923)
]);
myseries.slices.template.adapters.add("fill", function(fill, target) {
    var factor = Math.ceil(Math.max(data.length,10) / (myseries.slices.indexOf(target)+1));
    var gdegree = factor % 16;
    var gdegree = gdegree.toString(16);
    // console.log(`#5${gdegree}5`);
    return `#7${gdegree}7`;//chart.get("colors").getIndex(myseries.slices.indexOf(target));
    // when g > r colors tends to blue and its derivatives and vice versa.
    // blue, seablue, violete ... / red, brown, orange ...
  });
myseries.slices.template.adapters.add("stroke", () => 'aliceblue');

// The data is set directly on series via its data property:
data = [{
    country: "السودان",
    students: 3000
}, {
    country: "السعودية",
    students: 2000
}, {
    country: "مصر",
    students: 3000
},{
    country: "إِندونيسيا",
    students: 1000
}]

myseries.data.setAll(data);

// Admin dedicated charts: //////////////////////////////////////////////////////////////////////
var root2 = am5.Root.new("chartdiv2");
var chart2 = root2.container.children.push(
    am5percent.PieChart.new(root2, {
        layout: root2.verticalLayout,
        innerRadius: am5.percent(60)
    })
);

// Adding series. Pie chart supports one series type: PieSeries
var myseries2 = chart2.series.push(
    am5percent.PieSeries.new(root2, {
        name: "Series",
        categoryField: "country",
        valueField: "students",
    })
);

root2.setThemes([
    am5themes_Animated.new(root2)
]);

// Coloring one by one:
// myseries2.slices.template.adapters.add("fill", function(fill, target) {
//     switch (myseries2.slices.indexOf(target)) {
//         case 0:
//             return 'darkgoldenrod';
//             break;
//         case 1:
//             return 'green';
//             break;
//         default:
//             return 'blue';
//             break;
//     }
//   });

myseries2.animate({
    key: "startAngle",
    from: 270,
    to: 630,
    loops: 1,
    duration: 2000,
    easing: am5.ease.inOut(am5.ease.cubic) // linear (Constant speed during all duration) - circle - cubic elastic - ...
});
// myseries2.slices.template.setAll({tooltipText: ""})
myseries2.slices.template.adapters.add("stroke", () => 'whitesmoke'); //same as chartCard background
myseries2.slices.template.adapters.add("strokeWidth", () => 5);
myseries2.data.setAll(data);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var root3 = am5.Root.new("chartdiv3");
var chart3 = root3.container.children.push(
    am5xy.XYChart.new(root3, {

    })
);

root3.setThemes([
    am5themes_Animated.new(root3)
]);

// Create axes:
var xrend = am5xy.AxisRendererX.new(root3, {
    minGridDistance: 1,
    centerY: am5.p50,
    centerX: am5.p100,
});
xrend.labels.template.setAll({
    rotation: -15,
})
var xaxis = chart3.xAxes.push(am5xy.CategoryAxis.new(root3, {
    maxDeviation: 0.3,
    renderer: xrend,
    categoryField: "country",
    tooltip: am5.Tooltip.new(root3, {})
}));

var yrend = am5xy.AxisRendererY.new(root3, {});
yrend.labels.template.setAll({
    // rotation: -30,
    paddingLeft: 30,
});
var yaxis = chart3.yAxes.push(am5xy.ValueAxis.new(root3, {
    renderer: yrend,
}));

// Create series:
var myseries3 = chart3.series.push(am5xy.ColumnSeries.new(root3,{
    name: 'sereies',
    xAxis: xaxis,
    yAxis: yaxis,
    categoryXField: "country",
    valueYField: "students",
}));

// Column SIZE and border radius:
myseries3.columns.template.setAll({
    cornerRadiusTR: 30,
    cornerRadiusTL: 30,
    width: 50
})

//coloring:
myseries3.columns.template.adapters.add("fill", () => 'darkgoldenrod');
myseries3.columns.template.adapters.add("stroke", () => 'green');
myseries3.columns.template.adapters.add("strokeWidth", () => 7);

xaxis.data.setAll(data);
myseries3.data.setAll(data);

myseries3.appear(1000);
chart3.appear(1000, 100);

/* WARNING 1:  It's a good practice to make sure that setting data happens as late into code as possible. Once you set data, all related objects are created, 
so any configuration settings applied afterwards might not carry over.

WARNING 2: 
// ERROR: the following will result in error
var root = new am5.Root("chartdiv");
// SUCCESS: this is correct
var root = am5.Root.new("chartdiv");
This true not just for Root but for every single class in amCharts 5.

WARNING 3:
root.dispose();
Trying to create a new root element in a <div> container before disposing the old one that is currently residing there, will result in an error.
*/

