<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dip;     
class DipSeeder extends Seeder
{
    public function run()
    {
        $data1 = [
            [229, 5, 4],
            [230, 10, 9],
            [231, 15, 14],
            [232, 20, 21],
            [233, 25, 32],
            [234, 30, 40],
            [235, 35, 49],
            [236, 40, 59],
            [237, 45, 74],
            [238, 50, 85],
            [239, 55, 98],
            [240, 60, 113],
            [241, 65, 126],
            [242, 70, 138],
            [243, 75, 151],
            [244, 80, 172],
            [245, 85, 180],
            [246, 90, 200],
            [247, 95, 215],
            [248, 100, 237],
            [249, 105, 253],
            [250, 110, 260],
            [251, 115, 285],
            [252, 120, 309],
            [253, 125, 326],
            [254, 130, 343],
            [255, 135, 361],
            [256, 140, 387],
            [257, 145, 405],
            [258, 150, 452],
            [259, 155, 470],
            [260, 160, 490],
            [261, 165, 509],
            [262, 170, 539],
            [263, 175, 559],
            [264, 180, 579],
            [265, 185, 599],
            [266, 190, 630],
            [267, 195, 651],
            [268, 200, 672],
            [269, 205, 694],
            [270, 210, 726],
            [271, 215, 748],
            [272, 220, 770],
            [273, 225, 792],
            [274, 230, 826],
            [275, 235, 849],
            [276, 240, 872],
            [277, 245, 906],
            [278, 250, 930],
            [279, 255, 953],
            [280, 260, 977],
            [281, 265, 1013],
            [282, 270, 1037],
            [283, 275, 1061],
            [284, 280, 1085],
            [285, 285, 1122],
            [286, 290, 1147],
            [287, 295, 1172],
            [288, 300, 1197],
            [289, 305, 1236],
            [290, 310, 1261],
            [291, 315, 1287],
            [292, 320, 1313],
            [293, 325, 1357],
            [294, 330, 1378],
            [295, 335, 1404],
            [296, 340, 1444],
            [297, 345, 1471],
            [298, 350, 1498],
            [299, 355, 1524],
            [300, 360, 1580],
            [301, 365, 1592],
            [302, 370, 1603],
            [303, 375, 1619],
            [304, 380, 1647],
            [305, 385, 1689],
            [306, 390, 1717],
            [307, 395, 1745],
            [308, 400, 1773],
            [309, 405, 1815],
            [310, 410, 1844],
            [311, 415, 1872],
            [312, 420, 1901],
            [313, 425, 1944],
            [314, 430, 1973],
            [315, 435, 2002],
            [316, 440, 2031],
            [317, 445, 2075],
            [318, 450, 2105],
            [319, 455, 2134],
            [320, 460, 2179],
            [321, 465, 2208],
            [322, 470, 2239],
            [323, 475, 2269],
            [324, 480, 2314],
            [325, 485, 2344],
            [326, 490, 2374],
            [327, 495, 2405],
            [328, 500, 2451],
            [329, 505, 2481],
            [330, 510, 2512],
            [331, 515, 2543],
            [332, 520, 2590],
            [333, 525, 2621],
            [334, 530, 2683],
            [335, 540, 2730],
            [336, 545, 2762],
            [337, 550, 2794],
            [338, 555, 2841],
            [339, 560, 2873],
            [340, 565, 2905],
            [341, 570, 2937],
            [342, 575, 2985],
            [343, 580, 3017],
            [344, 585, 3049],
            [345, 590, 3082],
            [346, 595, 3130],
            [347, 600, 3163],
            [348, 605, 3195],
            [349, 610, 3228],
            [350, 615, 3277],
            [351, 620, 3310],
            [352, 625, 3343],
            [353, 630, 3376],
            [354, 635, 3426],
            [355, 640, 3459],
            [356, 645, 3492],
            [357, 650, 3542],
            [358, 655, 3576],
            [359, 660, 3609],
            [360, 665, 3643],
            [361, 670, 3693],
            [362, 675, 3727],
            [363, 680, 3760],
            [364, 685, 3794],
            [365, 690, 3845],
            [366, 695, 3879],
            [367, 700, 3913],
            [368, 705, 3947],
            [369, 710, 3998],
            [370, 715, 4033],
            [371, 720, 4067],
            [372, 725, 4101],
            [373, 730, 4153],
            [374, 735, 4187],
            [375, 740, 4222],
            [376, 745, 4256],
            [377, 750, 4308],
            [378, 755, 4343],
            [379, 760, 4378],
            [380, 765, 4430],
            [381, 770, 4465],
            [382, 775, 4500],
            [383, 780, 4535],
            [384, 785, 4587],
            [385, 790, 4622],
            [386, 800, 4693],
            [387, 810, 4781],
            [388, 815, 4816],
            [389, 820, 4851],
            [390, 825, 4904],
            [391, 830, 4940],
            [392, 835, 4975],
            [393, 840, 5011],
            [394, 845, 5064],
            [395, 850, 5100],
            [396, 855, 5135],
            [397, 860, 5189],
            [398, 865, 5224],
            [399, 870, 5260],
            [400, 875, 5296],
            [401, 880, 5350],
            [402, 885, 5386],
            [403, 890, 5421],
            [404, 895, 5457],
            [405, 900, 5511],
            [406, 905, 5547],
            [407, 910, 5583],
            [408, 915, 5619],
            [409, 920, 5673],
            [410, 925, 5709],
            [411, 930, 5746],
            [412, 935, 5782],
            [413, 940, 5836],
            [414, 945, 5872],
            [415, 950, 5908],
            [416, 955, 5963],
            [417, 960, 5999],
            [418, 965, 6035],
            [419, 970, 6072],
            [420, 975, 6126],
            [421, 980, 6163],
            [422, 985, 6199],
            [423, 990, 6235],
            [424, 995, 6290],
            [425, 1000, 6326],   
            [426, 1005, 6363],
            [427, 1010, 6399],
            [428, 1015, 6454],
            [429, 1020, 6490],
            [430, 1025, 6527],
            [431, 1030, 6563],
            [432, 1035, 6618],
            [433, 1040, 6655],
            [434, 1045, 6691],
            [435, 1050, 6746],
            [436, 1055, 6783],
            [437, 1060, 6819],
            [438, 1065, 6856],
            [439, 1070, 6910],
            [440, 1075, 6947],
            [441, 1080, 6984],
            [442, 1085, 7020],
            [443, 1090, 7075],
            [444, 1095, 7112],
            [445, 1100, 7145],
            [446, 1105, 7185],
            [447, 1110, 7222],
            [448, 1115, 7258],
            [449, 1120, 7295],
            [450, 1125, 7350],
            [451, 1130, 7386],
            [452, 1135, 7423],
            [453, 1140, 7460],
            [454, 1145, 7514],
            [455, 1150, 7551],
            [456, 1155, 7587],
            [457, 1160, 7624],
            [458, 1165, 7679],
            [459, 1170, 7715],
            [460, 1175, 7752],
            [461, 1180, 7807],
            [462, 1185, 7843],
            [463, 1190, 7880],
            [464, 1195, 7916],
            [465, 1200, 7971],
            [466, 1205, 8007],
            [467, 1210, 8044],
            [468, 1215, 8080],
            [469, 1220, 8135],
            [470, 1225, 8171],
            [471, 1230, 8207],
            [472, 1235, 8244],
            [473, 1240, 8298],
            [474, 1245, 8335],
            [475, 1250, 8371],
            [476, 1255, 8407],
            [477, 1260, 8462],
            [478, 1265, 8498],
            [479, 1270, 8534],
            [480, 1275, 8588],
            [481, 1280, 8624],
            [482, 1285, 8661],
            [483, 1290, 8697],
            [484, 1295, 8751],
            [485, 1300, 8787],
            [486, 1305, 8823],
            [487, 1310, 8859],
            [488, 1315, 8913],
            [489, 1320, 8949],
            [490, 1325, 8984],
            [491, 1330, 9020],
            [492, 1335, 9074],
            [493, 1340, 9110],
            [494, 1345, 9146],
            [495, 1350, 9181],
            [496, 1355, 9235],
            [497, 1360, 9270],
            [498, 1365, 9306],
            [499, 1370, 9359],
            [500, 1375, 9395],
            [501, 1380, 9430],
            [502, 1385, 9466],
            [503, 1390, 9519],
            [504, 1395, 9554],
            [505, 1400, 9589],
            [506, 1405, 9625],
            [507, 1410, 9677],
            [508, 1415, 9713],
            [509, 1420, 9748],
            [510, 1425, 9783],
            [511, 1430, 9835],
            [512, 1435, 9870],
            [513, 1440, 9905],
            [514, 1445, 9940],
            [515, 1450, 9992],
            [516, 1455, 10027],
            [517, 1460, 10062],
            [518, 1465, 10114],
            [519, 1470, 10148],
            [520, 1475, 10183],
            [521, 1480, 10217],
            [522, 1485, 10269],
            [523, 1490, 10303],
            [524, 1495, 10337],
            [525, 1500, 10372],
            [526, 1505, 10423],
            [527, 1510, 10457],
            [528, 1515, 10491],
            [529, 1520, 10525],
            [530, 1525, 10576],
            [531, 1530, 10610],
            [532, 1535, 10643],
            [533, 1540, 10677],
            [534, 1545, 10727],
            [535, 1550, 10761],
            [536, 1555, 10794],
            [537, 1560, 10828],
            [538, 1565, 10878],
            [539, 1570, 10911],
            [540, 1575, 10944],
            [541, 1580, 10994],
            [542, 1585, 11027],
            [543, 1590, 11060],
            [544, 1595, 11093],
            [545, 1600, 11142],
            [546, 1605, 11175],
            [547, 1610, 11207],
            [548, 1615, 11240],
            [549, 1620, 11288],
            [550, 1625, 11321],
            [551, 1630, 11353],
            [552, 1635, 11385],
            [553, 1640, 11430],
            [554, 1645, 11465],
            [555, 1650, 11497],
            [556, 1655, 11529],
            [557, 1660, 11576],
            [558, 1670, 11640],
            [559, 1675, 11687],
            [560, 1680, 11718],
            [561, 1685, 11748],
            [562, 1690, 11780],
            [563, 1695, 11827],
            [564, 1700, 11858],
            [565, 1705, 11889],
            [566, 1710, 11919],
            [567, 1715, 11965],
            [568, 1720, 11996],
            [569, 1725, 12056],
            [570, 1730, 12101],
            [571, 1735, 12131],
            [572, 1740, 12162],
            [573, 1745, 12191],
            [574, 1750, 12236],
            [575, 1755, 12265],
            [576, 1760, 12295],
            [577, 1765, 12339],
            [578, 1770, 12368],
            [579, 1775, 12397],
            [580, 1780, 12426],
            [581, 1785, 12469],
            [582, 1790, 12498],
            [583, 1795, 12526],
            [584, 1800, 12555],
            [585, 1805, 12597],
            [586, 1810, 12625],
            [587, 1815, 12653],
            [588, 1820, 12681],
            [589, 1825, 12723],
            [590, 1830, 12751],
            [591, 1835, 12778],
            [592, 1840, 12790],
            [593, 1845, 12846],
            [594, 1850, 12855],
            [595, 1855, 12872],
            [596, 1860, 12899],
            [597, 1865, 12926],
            [598, 1870, 12966],
            [599, 1875, 12992],
            [600, 1880, 13013],
            [601, 1885, 13057],
            [602, 1890, 13083],
            [603, 1895, 13109],
            [604, 1900, 13134],
            [605, 1905, 13173],
            [606, 1910, 13198],
            [607, 1915, 13223],
            [608, 1920, 13248],
            [609, 1925, 13285],
            [610, 1930, 13300],
            [611, 1935, 13333],
            [612, 1940, 13357],
            [613, 1945, 13393],
            [614, 1950, 13417],
            [615, 1955, 13440],
            [616, 1960, 13464],
            [617, 1965, 13498],
            [618, 1970, 13521],
            [619, 1975, 13578],
            [620, 1985, 13600],
            [621, 1990, 13622],
            [622, 1995, 13644],
            [623, 2000, 13676],
            [624, 2005, 13698],
            [625, 2010, 13719],
            [626, 2015, 13740],
            [627, 2020, 13771],
            [628, 2025, 13791],
            [629, 2030, 13811],
            [630, 2035, 13831],
            [631, 2040, 13861],
            [632, 2045, 13880],
            [633, 2050, 13900],
            [634, 2055, 13918],
            [635, 2060, 13946],
            [636, 2065, 13965],
            [637, 2070, 13983],
            [638, 2075, 14009],                           
        ];
        
        foreach ($data1 as [$value , $name, $liters]) {
        Dip::create([
            'name' => $name . ' ( ' . $liters . ' Liters )',
            'fuel_id' => 1,
            'status' => 'active',
            'value' => $value,
            ]);
        }

        $data2 = [
            [1, 2, 1],
            [2, 10, 11],
            [3, 20, 31],
            [4, 30, 56],
            [5, 40, 87],
            [6, 50, 121],
            [7, 60, 159],
            [8, 70, 200],
            [9, 80, 244],
            [10, 90, 291],
            [11, 100, 340],
            [12, 110, 392],
            [13, 120, 446],
            [14, 130, 502],
            [15, 140, 561],
            [16, 150, 621],
            [17, 160, 683],
            [18, 170, 747],
            [19, 180, 813],
            [20, 190, 880],
            [21, 200, 950],
            [22, 210, 1020],
            [23, 220, 1093],
            [24, 230, 1166],
            [25, 240, 1242],
            [26, 250, 1318],
            [27, 260, 1396],
            [28, 270, 1476],
            [29, 280, 1556],
            [30, 290, 1638],
            [31, 300, 1721],
            [32, 310, 1805],
            [33, 320, 1891],
            [34, 330, 1977],
            [35, 340, 2065],
            [36, 350, 2154],
            [37, 360, 2244],
            [38, 370, 2335],
            [39, 380, 2427],
            [40, 390, 2518],
            [41, 400, 2613],
            [42, 410, 2708],
            [43, 420, 2804],
            [44, 430, 2900],
            [45, 440, 2998],
            [46, 450, 3098],
            [47, 460, 3195],
            [48, 470, 3295],
            [49, 480, 3386],
            [50, 490, 3498],
            [51, 500, 3600],
            [52, 510, 3703],
            [53, 520, 3807],
            [54, 530, 3911],
            [55, 540, 4017],
            [56, 550, 4123],
            [57, 560, 4229],
            [58, 580, 4445],
            [59, 590, 4553],
            [60, 600, 4662],
            [61, 610, 4772],
            [62, 620, 4883],
            [63, 630, 4994],
            [64, 640, 5105],
            [65, 650, 5217],
            [66, 660, 5330],
            [67, 670, 5443],
            [68, 680, 5557],
            [69, 690, 5671],
            [70, 700, 5786],
            [71, 710, 5901],
            [72, 720, 6017],
            [73, 730, 6133],
            [74, 740, 6249],
            [75, 750, 6366],
            [76, 760, 6484],
            [77, 770, 6602],
            [78, 780, 6720],
            [79, 790, 6850],
            [80, 800, 6990],
            [81, 810, 7077],
            [82, 820, 7196],
            [83, 830, 7316],
            [84, 840, 7437],
            [85, 850, 7558],
            [86, 860, 7679],
            [87, 870, 7800],
            [88, 880, 7922],
            [89, 890, 8044],
            [90, 900, 8166],
            [91, 910, 8288],
            [92, 920, 8411],
            [93, 930, 8534],
            [94, 940, 8657],
            [95, 950, 8781],
            [96, 960, 8904],
            [97, 970, 9023],
            [98, 980, 9162],
            [99, 990, 9277],
            [100, 1000, 9401],
            [101, 1010, 9526],
            [102, 1020, 9651],
            [103, 1030, 9776],
            [104, 1040, 9901],
            [105, 1050, 10026],
            [106, 1060, 10151],
            [107, 1070, 10277],
            [108, 1080, 10402],
            [109, 1090, 10528],
            [110, 1100, 10654],
            [111, 1110, 10780],
            [112, 1120, 10906],
            [113, 1130, 11032],
            [114, 1140, 11158],
            [115, 1150, 11284],
            [116, 1160, 11410],
            [117, 1170, 11536],
            [118, 1180, 11662],
            [119, 1190, 11789],
            [120, 1200, 11915],
            [121, 1210, 12041],
            [122, 1220, 12167],
            [123, 1230, 12293],
            [124, 1240, 12420],
            [125, 1250, 12546],
            [126, 1260, 12672],
            [127, 1270, 12798],
            [128, 1280, 12924],
            [129, 1290, 13049],
            [130, 1300, 13176],
            [131, 1310, 13301],
            [132, 1320, 13426],
            [133, 1330, 13552],
            [134, 1340, 13677],
            [135, 1350, 13802],
            [136, 1360, 13927],
            [137, 1370, 14052],
            [138, 1380, 14177],
            [139, 1390, 14302],
            [140, 1400, 14426],
            [141, 1410, 14560],
            [142, 1420, 14674],
            [143, 1430, 14798],
            [144, 1440, 14922],
            [145, 1450, 15045],
            [146, 1460, 15168],
            [147, 1470, 15291],
            [148, 1480, 15414],
            [149, 1490, 15535],
            [150, 1500, 15658],
            [151, 1510, 15780],
            [152, 1520, 15902],
            [153, 1530, 16023],
            [154, 1540, 16144],
            [155, 1550, 16264],
            [156, 1560, 16385],
            [157, 1590, 16743], 
            [158, 1600, 16862],
            [159, 1610, 16981],
            [160, 1620, 17099],
            [161, 1630, 17216],
            [162, 1640, 17384],
            [163, 1650, 17450],
            [164, 1660, 17567],
            [165, 1670, 17683],
            [166, 1680, 17798],
            [167, 1690, 17913],
            [168, 1700, 18028],
            [169, 1710, 18142],
            [170, 1720, 18255],
            [171, 1730, 18368],
            [172, 1740, 18481],
            [173, 1750, 18592],
            [174, 1760, 18704],
            [175, 1770, 18815],
            [176, 1780, 18925],
            [177, 1790, 19034],
            [178, 1800, 19143],
            [179, 1810, 19252],
            [180, 1830, 19466],
            [181, 1840, 19573],
            [182, 1850, 19678],
            [183, 1860, 19783],
            [184, 1870, 19888],
            [185, 1880, 19991],
            [186, 1890, 20094],
            [187, 1900, 20196],
            [188, 1910, 20296],
            [189, 1920, 20398],
            [190, 1930, 20498],
            [191, 1940, 20596],
            [192, 1950, 20694],
            [193, 1960, 20792],
            [194, 1970, 20888],
            [195, 1980, 20983],
            [196, 1990, 21077],
            [197, 2000, 21171],
            [198, 2010, 21263],
            [199, 2020, 21355],
            [200, 2030, 21445],
            [201, 2040, 21535],
            [202, 2050, 21623],
            [203, 2060, 21710],
            [204, 2070, 21796],
            [205, 2080, 21861],
            [206, 2090, 21965],
            [207, 2100, 22048],
            [208, 2110, 22129],
            [209, 2120, 22209],
            [210, 2130, 22288],
            [211, 2140, 22366],
            [212, 2150, 22442],
            [213, 2160, 22516],
            [214, 2170, 22589],
            [215, 2180, 22661],
            [216, 2190, 22731],
            [217, 2200, 22800],
            [218, 2210, 22867],
            [219, 2220, 22932],
            [220, 2230, 22995],
            [221, 2240, 23056],
            [222, 2250, 23116],
            [223, 2260, 23174],
            [224, 2270, 23229],
            [225, 2280, 23282],
            [226, 2290, 23333],
            [227, 2300, 23381],
            [228, 2310, 23427],                                                                     
        ];

        foreach ($data2 as [$value , $name, $liters]) {
            Dip::create([
                'name' => $name . ' ( ' . $liters . ' Liters )',
                'fuel_id' => 2,
                'status' => 'active',
                'value' => $value,
            ]);
        }
    }       
}
