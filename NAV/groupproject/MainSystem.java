package groupproject;

import java.util.ArrayList;
import java.util.Scanner;
//inheritance - Student is super class and MainSystem is sub class
public class MainSystem extends Student{
	
	// array list of class Student which name application and it is static because in whole system we use the same data
	static ArrayList <Student> application = new ArrayList <Student>();  
	
	// Introduction method
	public static void intro() {
		System.out.println("************UTHM HOSTEL APPLICATION SYSTEM************");
		System.out.println("------------------------------------------------------");
		System.out.println("******* THIS SYSTEM IS FOR STUDENTS UTHM ONLY ********");
		System.out.println("------------------------------------------------------");
		System.out.println("************* ALL APPLICATION FOR A SEM **************");
		System.out.println("------------------------------------------------------");
	}	
	// input method with parameter ArrayList 
	public void input(ArrayList <Student> application) {
		Scanner sc = new Scanner (System.in);
		// input the data
	    System.out.print("Enter Matric No: ");
	    String matricNo = sc.nextLine();
	    System.out.print("Enter Name : ");
	    String name = sc.nextLine();
	    System.out.print("Enter Phone NO: ");
	    String phoneNo = sc.nextLine();
	    int hostel;
	    do {
		    System.out.print("(1): TDI"  +"\n"+ "(2): PERWIRA \n");
		    System.out.print("Selcet the HOSTEL :");
		    hostel = sc.nextInt();
	    	if(!(hostel == 1 || hostel == 2))// if input of hostel is not equal to 1 or 2
	    		System.out.print("Invalid input\n");
	    }while(!(hostel == 1 || hostel == 2)); //loop if input of hostel is not equal to 1 or 2 
	    
	    Student s1 = new Student(matricNo,name,phoneNo,hostel); //create object with parameter constructor
	    application.add(s1); //add array list by insert by object s1 
	    System.out.print("successful application\n");
	}
	
    public void display(ArrayList<Student> application ) {
    	int num = 1; 
        System.out.println("-------------------------------------------------------------------------");
        System.out.println("|No\t|Matric NO\t|Name\t\t\t|Phone NO\t|Hostel\t|");
        System.out.println("-------------------------------------------------------------------------");
        for(Student s: application) {//loop array list and assign the data to Student s
            System.out.println("|"+num+"\t"+s.toString()); // call the method toString of Student s
            num++;
        }
    }
    
    public void remove(ArrayList<Student> application ) {
        int num;
        Scanner input = new Scanner (System.in);
	    do {
	        System.out.print("Remove the application depend on No:");  
	        num = input.nextInt();
	    	if(num > application.size() || num < 1)
	    		System.out.print("Invalid input\n");
	    }while(num > application.size() || num < 1);	    	
	    num--;//because want to fulfill the array[0] start from 0
    	application.remove(num);//remove array list by No
	    System.out.print("successful remove an application\n");
    	display(application);
    }
    
    public void search(ArrayList<Student> application ) {
        int num;
        Scanner input = new Scanner (System.in);
	    do {
	        System.out.print("Select the application depend on the No :");  
	        num = input.nextInt();
	    	if(num > application.size() || num < 1)// if input of num is not larger than array list size of num less than 1
	    		System.out.print("Invalid input\n");
	    }while(num > application.size() || num < 1);//loop if input of num is not larger than array list size of num less than 1    	
	    num--;
	    Student s = application.get(num);
	    num++;
	    System.out.println("XXXXX Result of Seaching XXXXX"); 
        System.out.println("-------------------------------------------------------------------------");
	    System.out.println("|No\t|Matric NO\t|Name\t\t\t|Phone NO\t|Hostel\t|");
        System.out.println("-------------------------------------------------------------------------");
        System.out.println("|"+num+"\t"+s.toString());
         
    }
    
	public static void main(String[] args) { 
		intro();
		MainSystem ms = new MainSystem();
        int choose;
        Scanner input= new Scanner(System.in);
        do{

        System.out.println("\n++++++++++++++++ OPTION ++++++++++++++++"); 
        System.out.println("(1): APPLY FOR UTHM HOSTEL"  +"\n"+ "(2): CANCEL AN APPPLICATION " +"\n"+ "(3): SHOW LIST OF APPLICATION" +"\n"+ "(4): SEACH AN APPPLICATION" +"\n"+ "(5): EXIT THE SYSTEM"+"\n");  
        System.out.print("SELECT THE OPTION:");  
        choose = input.nextInt();
        System.out.println(""); 
        switch(choose){
            case 1:{
            	ms.input(application);
                break;
            }
            case 2:{
            	ms.remove(application);
                break;
            }
            case 3:{
            	ms.display(application);
                break;
            }
            case 4:{
            	ms.search(application);
                break;
            }
            case 5:{
                System.out.print("THANK YOU FOR USING OUR SYSTEM");  
                break;
            }
            default:{
                System.out.print("Invalid input ");  

            }
        }
        }while(choose != 5);
	        
	    
	}
	
	
}
