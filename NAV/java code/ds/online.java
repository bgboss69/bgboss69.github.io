public class online {
    public static void main(String[] args) {
        int MAX = Integer.MAX_VALUE;    // 无法到达时距离设为 Integer.MAX_VALUE
        int[][] weight={
        		{0.0,   12.8,  41.9,  0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },    
    		    {12.8,  0.0,   0.0,   87.9,  0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },    
    		    {41.9,  0.0,   0.0,   0.0,   63.9,  0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },     
    		    {0.0,   87.9,  0.0,   0.0,   0.0,   58.5,  0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },  
    		    {0.0,   0.0,   63.9,  0.0,   0.0,   0.0,   67.2,  0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },  
    		    {0.0,   0.0,   0.0,   58.5,  0.0,   0.0,   0.0,   30.8,  0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },  
    		    {0.0,   0.0,   0.0,   0.0,   67.2,  0.0,   0.0,   0.0,   0.0,    69.6,   0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },    
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   30.8,  0.0,   0.0,   64.5,   0.0,    0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },    
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   64.5,  0.0,    29.9,   0.0,    0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },   
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   69.6,  0.0,   29.9,   0.0,    54.6,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0 },    
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    54.6,   0.0,    0.0,   0.0,    0.0,    0.0,    34.8,  0.0 },     
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   122.4, 0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   51.4,   0.0,    0.0,    0.0,   0.0 },    
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    51.4,  0.0,    77.2,   0.0,    0.0,   0.0 },     
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   77.2,   0.0,    19.6,   0.0,   0.0 },     
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    19.6,   0.0,    0.0,   31.6},     
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    34.8,   0.0,   0.0,    0.0,    0.0,    0.0,   99.8},
    		    {0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,   0.0,    0.0,    0.0,    0.0,   0.0,    0.0,    31.8,   99.8,  0.0 } 	


                {MAX,   12.8,  41.9,  MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {12.8,  MAX,   MAX,   87.9,  MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {41.9,  MAX,   MAX,   MAX,   63.9,  MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },     
    		    {MAX,   87.9,  MAX,   MAX,   MAX,   58.5,  MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   63.9,  MAX,   MAX,   MAX,   67.2,  MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   58.5,  MAX,   MAX,   MAX,   30.8,  MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   MAX,   67.2,  MAX,   MAX,   MAX,   MAX,    69.6,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   30.8,  MAX,   MAX,   64.5,   MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   64.5,  MAX,    29.9,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },   
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   69.6,  MAX,   29.9,   MAX,    54.6,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    54.6,   MAX,    MAX,   MAX,    MAX,    MAX,    34.8,  MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   122.4, MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   51.4,   MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    51.4,  MAX,    77.2,   MAX,    MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   77.2,   MAX,    19.6,   MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    19.6,   MAX,    MAX,   31.6},     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    34.8,   MAX,   MAX,    MAX,    MAX,    MAX,   99.8},
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    31.8,   99.8,  MAX } 	
    
                {0.0,   12.8,  41.9,  MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {12.8,  0.0,   MAX,   87.9,  MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {41.9,  MAX,   0.0,   MAX,   63.9,  MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },     
    		    {MAX,   87.9,  MAX,   0.0,   MAX,   58.5,  MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   63.9,  MAX,   0.0,   MAX,   67.2,  MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   58.5,  MAX,   0.0,   MAX,   30.8,  MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   MAX,   67.2,  MAX,   0.0,   MAX,   MAX,    69.6,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   30.8,  MAX,   0.0,   64.5,   MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   64.5,  0.0,    29.9,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },   
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   69.6,  MAX,   29.9,   0.0,    54.6,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    54.6,   0.0,    MAX,   MAX,    MAX,    MAX,    34.8,  MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   122.4, MAX,   MAX,   MAX,    MAX,    MAX,    0.0,   51.4,   MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    51.4,  0.0,    77.2,   MAX,    MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   77.2,   0.0,    19.6,   MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    19.6,   0.0,    MAX,   31.6},     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    34.8,   MAX,   MAX,    MAX,    MAX,    0.0,   99.8},
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    31.8,   99.8,  0.0 }

                {0.0,   12.8,  41.9,  MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   0.0,   MAX,   87.9,  MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   0.0,   MAX,   63.9,  MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   0.0,   MAX,   58.5,  MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   MAX,   0.0,   MAX,   67.2,  MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   0.0,   MAX,   30.8,  MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },  
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   0.0,   MAX,   MAX,    69.6,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   0.0,   64.5,   MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   0.0,    29.9,   MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   MAX },   
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    0.0,    54.6,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    0.0,    MAX,   MAX,    MAX,    MAX,    34.8,  MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    0.0,   51.4,   MAX,    MAX,    MAX,   MAX },    
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   0.0,    77.2,   MAX,    MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    0.0,    19.6,   MAX,   MAX },     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    0.0,    MAX,   31.6},     
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    0.0,   99.8},
    		    {MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,   MAX,    MAX,    MAX,    MAX,   MAX,    MAX,    MAX,    MAX,   0.0 }

        };
        int start = 0;  // 选择出发点
        System.out.println(Arrays.toString(solution(weight,start)));
    }

    private static int[] solution(int[][] weight, int start) {
        boolean[] visit = new boolean[weight.length]; // 标记某节点是否被访问过
        int[] res = new int[weight.length];     // 记录 start 点到各点的最短路径长度
        for (int i = 0; i < res.length; i++) {
            res[i] = weight[start][i];
        }

        // 查找 n - 1 次（n 为节点个数），每次确定一个节点
        for(int i = 1; i < weight.length; i++) {
            int min = Integer.MAX_VALUE;
            int p = 0;
            // 找出一个未标记的离出发点最近的节点
            for(int j = 0; j < weight.length; j++){
                if(j != start && !visit[j] && res[j] < min){
                    min = res[j];
                    p = j;
                }
            }
            // 标记该节点为已经访问过
            visit[p] = true;

            for (int j = 0; j < weight.length; j++){
                if (j == p || weight[p][j] == Integer.MAX_VALUE) {  // p 点不能到达 j
                    continue;
                }
                if (res[p] + weight[p][j] < res[j]){
                    res[j] = res[p] + weight[p][j];  //更新最短路径
                }
            }
        }

        return res;
    }
}