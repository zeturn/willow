<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tree;
use Illuminate\Console\Command;

class TreeTableSeeder extends Seeder
{
    protected $signature = 'measure:time';

    protected $description = 'Measure the execution time of a code snippet';

    /**
     * Run the database seeds.
     * 执行填充
     *
     * @return void
     */
    public function run()
    {
        // 开始计时
        $start = microtime(true);

        // Create root node 创建根节点
        $rootNode = Tree::create([
            'name' => 'Cedrus',
            'parent_id' => null,
            'description'=>'A large and sturdy tree.',
            'status' => 1
        ]);

        // 学科 Categories array 
        $categories = [
            [
                'name' => '学科分类树',
                'children' => [
                    // 形式科学
                    [
                        'name' => '形式科学',
                        'children' => [
                            // 数学
                            [
                                'name' => '数学',
                                'children' => [
                                    [
                                        'name' => '代数',
                                        'children' => [
                                            [
                                                'name' => '群论',
                                                'children' => [
                                                    [
                                                        'name' => '群表示论',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '环论',
                                                'children' => [
                                                    [
                                                        'name' => '交换代数',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '体论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '线性代数（向量空间）',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '多重线性代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '李代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '结合代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '泛代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '同调代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '微分代数',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '格（序理论）',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '表示论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => 'K-理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '范畴论',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '数学分析',
                                        'children' => [
                                            [
                                                'name' => '实变函数论',
                                                'children' => [
                                                    [
                                                        'name' => '微积分学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '复分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '泛函分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '非标准分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '傅立叶分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '常微分方程',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '偏微分方程',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '概率论',
                                        'children' => [
                                            [
                                                'name' => '测度',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '遍历理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '随机过程',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '几何学与拓扑学',
                                        'children' => [
                                            [
                                                'name' => '平面几何学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '立体几何学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '解析几何学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '点集拓扑学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '代数拓扑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '微分拓扑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '代数几何',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '微分几何',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '射影几何',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '仿射几何学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '非欧几何',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '数论',
                                        'children' => [
                                            [
                                                'name' => '解析数论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '代数数论',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '逻辑与数学基础',
                                        'children' => [
                                            [
                                                'name' => '集合论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '证明论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '模型论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '可计算性理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '模态逻辑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '直觉主义逻辑',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '理论数学',
                                        'children' => [
                                            [
                                                'name' => '趣味数学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数学哲学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '应用数学',
                                        'children' => [
                                            [
                                                'name' => '统计学',
                                                'children' => [
                                                    [
                                                        'name' => '数理统计学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '计量经济学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '精算',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '人口学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '数值分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '运筹学',
                                                'children' => [
                                                    [
                                                        'name' => '最优化',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '线性规划',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '动态规划',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '任务分配问题',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '系统分析',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '随机过程',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '动力系统',
                                                'children' => [
                                                    [
                                                        'name' => '混沌理论',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '分形',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '数学物理',
                                                'children' => [
                                                    [
                                                        'name' => '量子力学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '量子场论',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '量子重力',
                                                        'children' => [
                                                            [
                                                                'name' => '弦理论',
                                                                'children' => []
                                                            ]
                                                        ]
                                                    ],
                                                    [
                                                        'name' => '统计力学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '计算理论',
                                                'children' => [
                                                    [
                                                        'name' => '计算复杂性理论',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '信息理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '密码学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '组合数学',
                                                'children' => [
                                                    [
                                                        'name' => '编码理论',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '图论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '博弈论',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                
                                ]
                            ],
                            // 统计学
                            [
                                'name' => '统计学',
                                'children' => [
                                    [
                                        'name' => '计算统计学',
                                        'children' => [
                                            [
                                                'name' => '数据挖掘',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '回归分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '模拟',
                                                'children' => [
                                                    [
                                                        'name' => '自助法',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '试验设计',
                                        'children' => [
                                            [
                                                'name' => '变异教分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '反应曲面法',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '调查取样',
                                        'children' => [
                                            [
                                                'name' => '抽样',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '统计模型',
                                        'children' => [
                                            [
                                                'name' => '生物统计学',
                                                'children' => [
                                                    [
                                                        'name' => '流行病学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '多变量分析',
                                                'children' => [
                                                    [
                                                        'name' => '时间序列',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '可靠度理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '品质控制',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '统计理论',
                                        'children' => [
                                            [
                                                'name' => '决策论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数理统计学',
                                                'children' => [
                                                    [
                                                        'name' => '概率',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '社会统计调查',
                                                'children' => []
                                            ]
                                        ]
                                    ]

                                ]
                            ],
                            // 系统科学
                            [
                                'name' => '系统科学',
                                'children' => [
                                    [
                                        'name' => '复杂系统',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '模控学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '控制理论',
                                        'children' => [
                                            [
                                                'name' => '控制工程',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '控制系统',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '动力系统',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '作业研究',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '系统动力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '系统工程',
                                        'children' => [
                                            [
                                                'name' => '系统分析',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '系统科学',
                                        'children' => [
                                            [
                                                'name' => '发展系统理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '动态系统理论',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 计算机科学
                            [
                                'name' => '计算机科学',
                                'children' => [
                                    [
                                        'name' => '计算理论',
                                        'children' => [
                                            [
                                                'name' => '自动机理论',
                                                'children' => [
                                                    [
                                                        'name' => '形式语言',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '可计算性理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算复杂性理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '并行性理论',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '算法',
                                        'children' => [
                                            [
                                                'name' => '随机化算法',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '分布式算法',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '并行算法',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机系统结构',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '操作系统',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '计算机网络',
                                        'children' => [
                                            [
                                                'name' => '信息理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '互联网，全球信息网',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '无线网络（移动计算）',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '普适计算',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '云计算',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机安全与可靠性',
                                        'children' => [
                                            [
                                                'name' => '密码学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '分布式计算',
                                        'children' => [
                                            [
                                                'name' => '网格计算',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '并行计算',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '量子计算机',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '软件工程',
                                        'children' => [
                                            [
                                                'name' => '形式化方法',
                                                'children' => [
                                                    [
                                                        'name' => '形式验证',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机图形学',
                                        'children' => [
                                            [
                                                'name' => '图像处理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '科学可视化',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算几何',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '程序语言',
                                        'children' => [
                                            [
                                                'name' => '编程范型',
                                                'children' => [
                                                    [
                                                        'name' => '面向对象程序设计',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '函数式编程语言',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '形式语义学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '类型论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '编译器',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '商业信息学',
                                        'children' => [
                                            [
                                                'name' => '信息科技',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '管理信息系统',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '医学信息学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '人机交互',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '信息学',
                                        'children' => [
                                            [
                                                'name' => '数据管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数据挖掘',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数据库',
                                                'children' => [
                                                    [
                                                        'name' => '关系数据库',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '信息检索',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '信息管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '知识管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '多媒体',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '人工智能',
                                        'children' => [
                                            [
                                                'name' => '认知科学',
                                                'children' => [
                                                    [
                                                        'name' => '自动推理',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '机器学习',
                                                        'children' => [
                                                            [
                                                                'name' => '人工神经网络',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '支持向量机',
                                                                'children' => []
                                                            ]
                                                        ]
                                                    ],
                                                    [
                                                        'name' => '自然语言处理',
                                                        'children' => [
                                                            [
                                                                'name' => '计算语言学',
                                                                'children' => []
                                                            ]
                                                        ]
                                                    ],
                                                    [
                                                        'name' => '计算机视觉',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '专家系统',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '在数学、自然科学、工程学与医学上的运算',
                                        'children' => [
                                            [
                                                'name' => '数值分析',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算数学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算科学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算物理学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算化学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算神经科学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算机辅助工程',
                                                'children' => [
                                                    [
                                                        'name' => '有限元素分析',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '计算流体力学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '在社会科学、艺术、人文学科与职业上的运算',
                                        'children' => [
                                            [
                                                'name' => '计算社会学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '金融工程学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机与社会',
                                        'children' => [
                                            [
                                                'name' => '计算机硬件历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '计算机科学历史',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 逻辑
                            [
                                'name' => '逻辑',
                                'children' => [
                                    [
                                        'name' => '数理逻辑',
                                        'children' => [
                                            [
                                                'name' => '集合论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '证明论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '模型论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '可计算性理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '模态逻辑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '直觉主义逻辑',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '哲学逻辑',
                                        'children' => [
                                            [
                                                'name' => '模态逻辑',
                                                'children' => [
                                                    [
                                                        'name' => '义务逻辑',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '信念逻辑',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '逻辑推理',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机逻辑',
                                        'children' => [
                                            [
                                                'name' => '形式语义学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '形式化方法',
                                                'children' => [
                                                    [
                                                        'name' => '形式验证',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '类型论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '逻辑编程',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '多值逻辑',
                                                'children' => [
                                                    [
                                                        'name' => '模糊逻辑',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    // 自然科学
                    [
                        'name' => '自然科学',
                        'children' => [
                            // 太空科学
                            [
                                'name' => '太空科学',
                                'children' => [
                                    [
                                        'name' => '天体生物学 / 宇宙生物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '宇宙学',
                                        'children' => [
                                            [
                                                'name' => '行星科学',
                                                'children' => [
                                                    [
                                                        'name' => '行星地质学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '恒星天文学',
                                                'children' => [
                                                    [
                                                        'name' => '太阳天文学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '月质学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '天文学',
                                        'children' => [
                                            [
                                                'name' => '观测天文学',
                                                'children' => [
                                                    [
                                                        'name' => '无线电天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '微波天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '红外天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '可见光天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '紫外线天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => 'X射线天文学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '伽玛射线',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '天文物理学',
                                        'children' => [
                                            [
                                                'name' => '重力论',
                                                'children' => [
                                                    [
                                                        'name' => '黑洞',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '星际物质',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '直接数值模拟',
                                                'children' => [
                                                    [
                                                        'name' => '等离子体天体物理学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '星系的形成和演化',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '高能天文物理学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '流体动力学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '磁流体力学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '恒星形成',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '物理宇宙学',
                                                'children' => [
                                                    [
                                                        'name' => '量子力学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '恒星天文物理学',
                                                'children' => [
                                                    [
                                                        'name' => '日震',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '恒星演化',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '恒星核合成',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 生命科学
                            [
                                'name' => '生命科学',
                                'children' => [
                                    // 生物学
                                    [
                                        'name' => '生物学',
                                        'children' => [
                                            [
                                                'name' => '演化论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '解剖学',
                                                'children' => [
                                                    [
                                                        'name' => '比较解剖学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '人体解剖学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '植物学',
                                                'children' => [
                                                    [
                                                        'name' => '民族植物学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '藻类学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '生物地理学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '细胞生物学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '时间生物学（生物钟学）',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '低温生物学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '发育生物学',
                                                'children' => [
                                                    [
                                                        'name' => '胚胎学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '生态学',
                                                'children' => [
                                                    [
                                                        'name' => '人类生态学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '景观生态学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '遗传学',
                                                'children' => [
                                                    [
                                                        'name' => '分子遗传学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '群体遗传学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '内分泌学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '演化生物学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '人体生物学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '海洋生物学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '生物化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生物信息学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生物物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '湖沼学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生命工学',
                                        'children' => [
                                            [
                                                'name' => '克隆学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '生物分类法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '真菌学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '寄生虫学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '病理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生理学',
                                        'children' => [
                                            [
                                                'name' => '人体生理学',
                                                'children' => [
                                                    [
                                                        'name' => '运动生理学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '系统分类学（分类学）',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 化学
                            [
                                'name' => '化学',
                                'children' => [
                                    [
                                        'name' => '量子化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '无机化学',
                                        'children' => [
                                            [
                                                'name' => '元素化学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '无机合成化学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '有机化学',
                                        'children' => [
                                            [
                                                'name' => '有机金属化学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '有机合成化学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '天然有机化学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '物理化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '核化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '食品化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '辐射化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '理论化学',
                                        'children' => [
                                            [
                                                'name' => '化学哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '量子化学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '大气化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '地球化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '宇宙化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '分析化学',
                                        'children' => [
                                            [
                                                'name' => '仪器分析',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '生物化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '药物化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '化学信息学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '计算化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '材料科学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土壤化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '石油化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '环境化学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '化学工业',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 物理学
                            [
                                'name' => '物理学',
                                'children' => [
                                    [
                                        'name' => '声学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '应用物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '天体物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '原子，分子与光学物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生物物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '计算物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '凝聚态物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '低温物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '电磁学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '粒子物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '流体动力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '地球物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '材料科学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '数学物理',
                                        'children' => []
                                    ],                        
                                    [
                                        'name' => '医学物理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '分子物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '牛顿力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '原子核物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '光学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '等离子体',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '量子力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '固体力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '固体物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '统计力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '理论物理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '热力学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '车辆动力学',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 地球科学
                            [
                                'name' => '地球科学',
                                'children' => [
                                    [
                                        'name' => '水文学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '气象学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '矿物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '海洋学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土壤学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '古生物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '行星科学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土壤科学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '地质构造',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '火山学',
                                        'children' => []
                                    ]
                                ]
                            ]
                        ]
                    ],
                    // 社会科学
                    [
                        'name' => '社会科学',
                        'children' => [
                            // 历史学
                            [
                                'name' => '历史学',
                                'children' => [
                                    [
                                        'name' => '古代史',
                                        'children' => [
                                            [
                                                'name' => '史前史',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '文化史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '外交史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '文学史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '经济史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '政治史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '方志学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '系谱学/谱牒学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '民族历史学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '传播史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '考古学',
                                        'children' => [
                                            [
                                                'name' => '地质历史学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '科技史（科学技术史）',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事史/战争史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '现代史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '艺术史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '金石学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '哲学史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法制史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '世界史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '历史地理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生物学史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '自然史/博物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '历史语言学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '以地区划分的历史',
                                        'children' => [
                                            [
                                                'name' => '非洲史',
                                                'children' => [
                                                    [
                                                        'name' => '古埃及历史',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '美国历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '阿根廷历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '中国历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '日本历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '欧洲历史',
                                                'children' => [
                                                    [
                                                        'name' => '古罗马历史',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '古希腊历史',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '美索不达米亚历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '印度历史',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '印度尼西亚历史',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 地理学
                            [
                                'name' => '地理学',
                                'children' => []
                            ],
                            // 心理学
                            [
                                'name' => '心理学',
                                'children' => []
                            ],
                            // 社会学
                            [
                                'name' => '社会学',
                                'children' => []
                            ],
                            // 经济学
                            [
                                'name' => '经济学',
                                'children' => []
                            ],
                            // 政治科学
                            [
                                'name' => '政治科学',
                                'children' => []
                            ],
                            // 人类学
                            [
                                'name' => '人类学',
                                'children' => []
                            ],
                            // 语言学
                            [
                                'name' => '语言学',
                                'children' => []
                            ],
                            // 考古学
                            [
                                'name' => '考古学',
                                'children' => []
                            ],
                            // 性别与性欲特质研究
                            [
                                'name' => '性别与性欲特质研究',
                                'children' => []
                            ],
                            // 文化与种族研究
                            [
                                'name' => '文化与种族研究',
                                'children' => []
                            ]
                        ]
                    ],
                    // 人文学科和艺术
                    [
                        'name' => '人文学科和艺术',
                        'children' => [
                            // 区域研究
                            [
                                'name' => '区域研究',
                                'children' => []
                            ],
                            // 视觉艺术
                            [
                                'name' => '视觉艺术',
                                'children' => []
                            ],
                            // 文学
                            [
                                'name' => '文学',
                                'children' => [
                                    // 英文研究
                                    [
                                        'name' => '英文研究',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 表演艺术
                            [
                                'name' => '表演艺术',
                                'children' => [
                                    // 音乐
                                    [
                                        'name' => '音乐',
                                        'children' => []
                                    ],
                                    // 舞蹈
                                    [
                                        'name' => '舞蹈',
                                        'children' => []
                                    ],
                                    // 戏剧
                                    [
                                        'name' => '戏剧',
                                        'children' => []
                                    ],
                                    // 电影
                                    [
                                        'name' => '电影',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 哲学
                            [
                                'name' => '哲学',
                                'children' => [
                                    [
                                        'name' => '形而上学',
                                        'children' => [
                                            [
                                                'name' => '本体论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '目的论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '心灵哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '行动理论',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '知识论',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '伦理学',
                                        'children' => [
                                            [
                                                'name' => '规范伦理学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '元伦理学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '价值理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '道德心理学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '应用伦理学',
                                                'children' => [
                                                    [
                                                        'name' => '动物权利',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '生物伦理学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '环境伦理',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '美学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会哲学与政治哲学',
                                        'children' => [
                                            [
                                                'name' => '女性主义哲学',
                                                'children' => [
                                                    [
                                                        'name' => '女权论',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '无政府主义',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '马克思主义',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '哲学传统与学派',
                                        'children' => [
                                            [
                                                'name' => '非洲哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '亚里士多德学派',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '分析哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '欧陆哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '东方哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '女性主义哲学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '哲学史',
                                        'children' => [
                                            [
                                                'name' => '古代哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '中国哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '中世纪哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '17世纪哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '当代哲学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '逻辑学',
                                        'children' => [
                                            [
                                                'name' => '哲学逻辑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数理逻辑',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '应用哲学',
                                        'children' => [
                                            [
                                                'name' => '教育哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '历史哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '宗教哲学',
                                                'children' => [
                                                    [
                                                        'name' => '神学',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '语言哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数学哲学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '科学哲学',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 哲学
                            // 宗教研究
                            [
                                'name' => '宗教研究',
                                'children' => [
                                    [
                                        'name' => '亚伯拉罕诸教',
                                        'children' => [
                                            [
                                                'name' => '基督教',
                                                'children' => [
                                                    [
                                                        'name' => '基督教神学',
                                                        'children' => [
                                                            [
                                                                'name' => '圣经神学',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '解释学',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '神学主体',
                                                                'children' => [
                                                                    [
                                                                        'name' => '基督论',
                                                                        'children' => []
                                                                    ],
                                                                    [
                                                                        'name' => '圣灵学',
                                                                        'children' => []
                                                                    ]
                                                                ]
                                                            ],
                                                            [
                                                                'name' => '救赎论',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '法律和福音',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '教会学',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '末世论',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '罪论',
                                                                'children' => []
                                                            ],
                                                            [
                                                                'name' => '自然神学',
                                                                'children' => []
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '伊斯兰教',
                                                'children' => [
                                                    [
                                                        'name' => '伊斯兰教史',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '古兰经',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '圣训',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '犹太教',
                                                'children' => [
                                                    [
                                                        'name' => '犹太教史',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '犹太哲学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '塔木德',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '哈拉卡',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '米德拉什',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '印度宗教',
                                        'children' => [
                                            [
                                                'name' => '佛教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '印度教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '耆那教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '锡克教',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '东亚宗教',
                                        'children' => [
                                            [
                                                'name' => '中国民间宗教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '儒家',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '神道',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '道教',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '其他宗教',
                                        'children' => [
                                            [
                                                'name' => '古埃及宗教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '诺斯底主义',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '西方神秘传统',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '新兴宗教',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '祆教',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '无神论与宗教人文主义',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '宗教比较',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '神话与民俗学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '符号学',
                                        'children' => []
                                    ]
                                ]
                            ]
                            ]
                        
                    ],
                    // 职业与应用科学
                    [
                        'name' => '职业与应用科学',
                        'children' => [
                            // 农业/农学
                            [
                                'name' => '农业/农学',
                                'children' => [
                                    [
                                        'name' => '农学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '林学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土壤学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '昆虫学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '植物病理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '农业经济学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '农产品运销学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '水产学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '园艺学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '植物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '动物学',
                                        'children' => []
                                    ]
                                ]                        
                            ],
                            // 工商管理
                            [
                                'name' => '工商管理',
                                'children' => [
                                    [
                                        'name' => '会计学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '商业学/职业道德',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '金融学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '技术经济及管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '农林经济管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '林业经济管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '公共管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '行政管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会医学与卫生事业管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育经济与管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会保障',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土地资源管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '劳资关系/劳动经济学/劳动史/劳动统计学',
                                        'children' => [
                                            [
                                                'name' => '国际相对劳动',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '信息系统',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '管理学',
                                        'children' => [
                                            [
                                                'name' => '人力资源管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '财务管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '市场营销学',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '旅游管理/导游/酒店管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '制造业',
                                        'children' => []
                                    ]
                                ]                        
                            ],
                            // 企业
                            [
                                'name' => '企业',
                                'children' => [
                                    [
                                        'name' => '工商管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '企业分析',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '商业道德',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '商法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => 'E化企业',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '企业家精神',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '金融',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '劳资关系/集体谈判/人力资源/组织行为学/劳动经济学/劳工史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '国际贸易',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '市场营销',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '采购',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '风险管理和保险',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '系统科学',
                                        'children' => []
                                    ]
                                ]
                                
                            ],
                            // 语言
                            [
                                'name' => '语言',
                                'children' => [
                                    [
                                        'name' => '英语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '德语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '俄语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '意大利语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '西班牙语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '葡萄牙语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '丹麦语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '匈牙利语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '挪威语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '亚美尼亚语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '瑞典语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '芬兰语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '中国语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '日语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '朝鲜语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '越南语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '泰语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '斯瓦西里语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '印度语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '阿拉伯语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '塞尔维亚语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '荷兰语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '冰岛语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '希腊语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '罗马尼亚语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '拉丁语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '梵语',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '世界语',
                                        'children' => []
                                    ]
                                ]                        
                            ],
                            // 神学
                            [
                                'name' => '神学',
                                'children' => [
                                    [
                                        'name' => '基督教历史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教会法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '宣教场',
                                        'children' => [
                                            [
                                                'name' => '教牧辅导',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '教牧神学',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                                
                            ],
                            // 建筑与设计
                            [
                                'name' => '建筑与设计',
                                'children' => [
                                    [
                                        'name' => '建筑和相关设计',
                                        'children' => [
                                            [
                                                'name' => '建筑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '都市规划',
                                                'children' => [
                                                    [
                                                        'name' => '城市设计',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '室内设计',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '景观设计',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '纪念物保存',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '工业设计',
                                        'children' => [
                                            [
                                                'name' => '人因工程学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '游戏设计',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '玩具与娱乐设计',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '时装设计',
                                        'children' => [
                                            [
                                                'name' => '奢饰品设计',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '珠宝设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '玩具设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '视觉传达设计',
                                        'children' => [
                                            [
                                                'name' => '平面设计',
                                                'children' => [
                                                    [
                                                        'name' => '字体设计',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '用户界面设计',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '工程制图',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '建筑学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '建筑设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '空间设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '包装设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '商业设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '广告设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '造型设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '多媒体',
                                        'children' => []
                                    ]
                                ]
                                
                            ],
                            // 教育
                            [
                                'name' => '教育',
                                'children' => [
                                    [
                                        'name' => '批判性教学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '课程设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育行政',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教学领导',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育哲学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育心理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '教育社会学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '远距教育',
                                        'children' => [
                                            [
                                                'name' => '小学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '中学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '高等教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '掌握学习',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '职业教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '双语教学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '军事教育',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '专业教育',
                                        'children' => [
                                            [
                                                'name' => '语言教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '数学教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '音乐教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '艺术教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '道德教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '体育教育/教练',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '阅读教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '科学教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '特殊教育',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '幼儿教育',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                                
                            ],
                            // 工程学
                            [
                                'name' => '工程学',
                                'children' => [
                                    [
                                        'name' => '航空航天工程',
                                        'children' => [
                                            ['name' => '航空工程', 'children' => []],
                                            ['name' => '太空工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '农业工程',
                                        'children' => [
                                            ['name' => '食品工程', 'children' => []],
                                            ['name' => '水土保持', 'children' => []],
                                            ['name' => '农业机械', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '建筑工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生物工程学',
                                        'children' => [
                                            ['name' => '生物材料工程', 'children' => []],
                                            ['name' => '生物医学工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '化学工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '土木工程',
                                        'children' => [
                                            ['name' => '土力工程', 'children' => []],
                                            ['name' => '工程地质学', 'children' => []],
                                            ['name' => '地震工程', 'children' => []],
                                            ['name' => '运输工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '计算机工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '控制工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生态工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '电机工程学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '电子工程',
                                        'children' => [
                                            ['name' => '微电子工程', 'children' => []],
                                            ['name' => '广播工程', 'children' => []],
                                            ['name' => '音讯工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '工程物理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '环境工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '工业工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '材料科学',
                                        'children' => [
                                            ['name' => '陶瓷工程', 'children' => []],
                                            ['name' => '冶金工程', 'children' => []],
                                            ['name' => '高分子材料工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '机械工程',
                                        'children' => [
                                            ['name' => '动力机械工程', 'children' => []],
                                            ['name' => '机械设计工程', 'children' => []],
                                            ['name' => '机械材料工程', 'children' => []],
                                            ['name' => '桥梁工程', 'children' => []],
                                            ['name' => '制造工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '机电整合工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '矿业工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '纳米工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '核工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '海洋工程',
                                        'children' => [
                                            ['name' => '轮机工程', 'children' => []],
                                            ['name' => '船舶工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '光学工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '品质保证工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '石油工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '安全工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '软件工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '结构工程学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '系统工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '通信工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '车辆工程',
                                        'children' => [
                                            ['name' => '汽车工程', 'children' => []]
                                        ]
                                    ],
                                    [
                                        'name' => '包装工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '声学工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '仪表工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战地工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '自动化',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 家政学
                            [
                                'name' => '家政学',
                                'children' => [
                                    [
                                        'name' => '消费者教育',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '室内设计',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '营养学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '纺织',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家庭经济学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '儿童心理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '生理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '人口学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '遗传学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '优生学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '人才学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '伦理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '美学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '灾难应对',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '管理学原理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会学概论',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会工作原理与实务',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会科学研究方法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家庭服务业概论',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家政学原理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家政思想史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家庭社会学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家庭教育学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家庭经济学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '家政管理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '健康管理学',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 环境研究与林业
                            [
                                'name' => '环境研究与林业',
                                'children' => [
                                    
                                        [
                                            'name' => '环境资源管理',
                                            'children' => [
                                                ['name' => '海岸管理', 'children' => []],
                                                ['name' => '渔业管理', 'children' => []],
                                                ['name' => '土地管理', 'children' => []],
                                                ['name' => '自然资源管理', 'children' => []],
                                                ['name' => '野生动物管理', 'children' => []]
                                            ]
                                        ],
                                        [
                                            'name' => '环境科学基本原理',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境伦理学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '综合自然地理学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境人类学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境政策',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境政治',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '城市规划',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境法',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境经济学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境哲学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境社会学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境正义（社会公正）',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境规划',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '污染控制',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境资源管理',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '休闲生态学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '林学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '可持续发展',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '毒理学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '物理科学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境商业学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境经济学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '人文科学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '环境社会科学',
                                            'children' => []
                                        ],
                                        [
                                            'name' => '生态学',
                                            'children' => []
                                        ]
                                ]
                            ],
                            // 健康科学
                            [
                                'name' => '健康科学',
                                'children' => [
                                    // 医学
                                    [
                                        'name' => '医学',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 新闻学，媒体研究和传播学
                            [
                                'name' => '新闻学，媒体研究和传播学',
                                'children' => [
                                    [
                                        'name' => '新闻学',
                                        'children' => [
                                            [
                                                'name' => '广播新闻学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '新媒体',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '体育事件广播',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '媒体研究（大众媒体）',
                                        'children' => [
                                            [
                                                'name' => '报纸',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '杂志',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '无线电',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '电视',
                                                'children' => [
                                                    [
                                                        'name' => '电视研究',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '互联网',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '传播学',
                                        'children' => [
                                            [
                                                'name' => '信息理论',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '广告',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '广告学',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '市场行销',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '大众传播',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '翻译',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '政治宣传',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '公共关系',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '非言语交际',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                                
                            ],
                            // 法律
                            [
                                'name' => '法律',
                                'children' => [
                                    [
                                        'name' => '法理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法律哲学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '比较法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法律社会学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法律史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法律经济学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '宪法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '国内法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '国际法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '实体法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '程序法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '公法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '私法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '民法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '刑法',
                                        'children' => [
                                            [
                                                'name' => '刑事诉讼法',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '刑事司法',
                                                'children' => [
                                                    [
                                                        'name' => '警政学',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '取证',
                                                        'children' => []
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '土地法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '会计法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '公司法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '合同法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '环境法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '劳动法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '知识产权法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '税法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '侵权',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '行政法',
                                        'children' => [
                                            [
                                                'name' => '行政诉讼法',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '教会法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '欧陆法系',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '英美法系',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '中华法系',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '伊斯兰律法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '法律教育',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 图书馆与博物馆研究
                            [
                                'name' => '图书馆与博物馆研究',
                                'children' => [
                                    [
                                        'name' => '档案学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '书目计量学',
                                        'children' => [
                                            [
                                                'name' => '引文分析',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '信息架构',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '图书馆学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '博物馆学',
                                        'children' => [
                                            [
                                                'name' => '艺术管理',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 军事学
                            [
                                'name' => '军事学',
                                'children' => [
                                    [
                                        'name' => '军事思想',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战争',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '武装力量',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军队',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事家',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战略学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '地缘战略',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事制度',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军队政治工作学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事历史学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事地理学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事科学技术',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '陆军',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '海军',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '空军',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '装甲兵',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事技术与装备',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '边缘学科',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事语言学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事史',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战役',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '兵法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事著作',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事演习',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事行动',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事策划',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事比较系统',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '博弈论',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '作战研究',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '领导学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '后勤',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事道德',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事情报',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '军事医学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '海军学',
                                        'children' => [
                                            [
                                                'name' => '海事工程',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '海上战术',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '海事建筑',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '武器系统',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '特别行动及低强度冲突',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战略',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '战术',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 公共行政
                            [
                                'name' => '公共行政',
                                'children' => [
                                    [
                                        'name' => '矫正',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '保育生物学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '刑事司法',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '灾害管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '政府事务',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '国际关系',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '公共行政',
                                        'children' => [
                                            [
                                                'name' => '非营利组织管理',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '非政府组织管理',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '公共政策',
                                        'children' => [
                                            [
                                                'name' => '国内政策',
                                                'children' => [
                                                    [
                                                        'name' => '卫生政策研究',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '住宅政策',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '劳工政策',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '社会政策',
                                                        'children' => []
                                                    ],
                                                    [
                                                        'name' => '娱乐事业管理',
                                                        'children' => []
                                                    ]
                                                ]
                                            ],
                                            [
                                                'name' => '毒品禁制政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '能源政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '环境政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '财政政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '外交政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '移民政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '产业关系',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            // 社会工作
                            [
                                'name' => '社会工作',
                                'children' => [
                                    [
                                        'name' => '儿童福利',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社区实践',
                                        'children' => [
                                            [
                                                'name' => '社区组织',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '社会政策',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '社会法',
                                                'children' => []
                                            ],
                                            [
                                                'name' => '社会行政',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '矫正',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '老人学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '医疗社会工作',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '心理健康',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '校园辅导',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会团体工作',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '社会个案工作',
                                        'children' => []
                                    ]
                                ]
                            ],
                            // 交通运输
                            [
                                'name' => '交通运输',
                                'children' => [
                                    [
                                        'name' => '运输学',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '交通安全',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '信息图形',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '船运',
                                        'children' => [
                                            [
                                                'name' => '港埠管理',
                                                'children' => []
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => '作业研究',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '公共运输',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '交通工程',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '交通控制',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '物流管理',
                                        'children' => []
                                    ],
                                    [
                                        'name' => '运输政策',
                                        'children' => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        // Fill the category tree
        $this->fillCategoryTree($rootNode, $categories);

        // 文化 Categories array 
        $categories = [
            [
                'name' => '文化分类树',
                'children' => [

                ]
            ]
        ];
        // Fill the category tree
        $this->fillCategoryTree($rootNode, $categories);

        // 结束计时
        $end = microtime(true);

        // 计算所需时间（毫秒）
        $executionTime = round(($end - $start) * 1000, 2);

        // 输出所需时间到终端
        echo 'Tree 在 ' . $executionTime . ' ms 内完成填充' . PHP_EOL;
    }

    /**
     * Recursively fill the category tree.
     * 递归回填
     * 
     * @param \App\Models\Category $parent
     * @param array $categories
     * @return void
     */
    private function fillCategoryTree(Tree $parent, array $categories)
    {
        foreach ($categories as $categoryData) {
            $category = Tree::create([
                'name' => $categoryData['name'],
                'parent_id' => $parent->id,
                'description' => '这是一个分类页面',
                'status' => 1
            ]);

            if (!empty($categoryData['children'])) {
                $this->fillCategoryTree($category, $categoryData['children']);
            }
        }
    }
}
// php artisan db:seed --class=TreeTableSeeder