package ds;

import java.text.DecimalFormat;

public class test {
	
	static final int num_Vertices = 5;
	
	// Method to find minimum distance
	double minDistance(double dist[], Boolean sptSet[]){
		// Initialize minimum value
		double min = Integer.MAX_VALUE, min_index = -1;
		
		for (int v = 0; v < num_Vertices; v++) {
			if (sptSet[v] == false && dist[v] <= min){
				min = dist[v]; 
				min_index = v;
			}
		}
		return min_index;
	}
	
	// Method to print the result
	void printMinpath(double dist[]){
		
		DecimalFormat df = new DecimalFormat("0.0"); // Decimal format output 
		System.out.println("Vertex# \t Shortest Distance from Source Vertex");
		
		for (int i = 0; i <num_Vertices; i++)
			System.out.println(i + "\t\t\t "+ df.format(dist[i]));
	}

	
	//Method to implement the Dijkstra algorithm into the graph 
	void algo_dijkstra(double graph[][], int src){
		double dist[] = new double[num_Vertices];
		Boolean sptSet[] = new Boolean[num_Vertices];
		
		//Initialize all distances as INFINITE and sptSet[] as false 
		for (int i = 0; i <num_Vertices; i++){
			dist[i] =Integer.MAX_VALUE;
			sptSet[i] = false;
		}

		//Distance to source vertex is set as 0 
		dist[src] = 0;
		
		for(int count = 0; count <num_Vertices - 1; count++) {
			double u = minDistance(dist,sptSet);
			sptSet[(int)u] = true; // The vertex is included in sptSet
			//Update the distance value of all adjacent vertices of picked vertex(u) 
			for (int v = 0; v < num_Vertices; v++) {
				//If sum of distance value of u(from source) and weight of edge u-vis
				// less than the distance value of v, then update the distance value of v
				if(!sptSet[v] && graph[(int)u][v]!=0 && dist[(int)u] != Integer.MAX_VALUE && dist[(int) u] + graph[(int) u][v]< dist[v]){ 
					dist[v] = dist[(int)u] + graph[(int)u][v];
				}
			}
		}
		printMinpath(dist);
	}
	
	
	public static void main(String[] args) {
		//5*5 adj matrix of graph
		double graph[][]= new double[][]
			{
				{0.0,34.6,28.0,0.0,0.0},
				{0.0,34.6,0.0,28.0,0.0},
				{0.0,34.6,28.0,0.0,0.0},
				{34.6,0.0,28.0,0.0,28.0},
				{0.0,34.6,28.0,28.0,0.0}
			};
			test g = new test(); 
			g.algo_dijkstra(graph,0);
	}
		
}