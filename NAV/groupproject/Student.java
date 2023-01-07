package groupproject;
//public student class
public class Student {
	// private attribute
    private String name;
    private String phoneNo;
    private String matricNo;
    private int hostel;

    public Student () {}
    
    public Student (String matricNo, String name,String phoneNo, int hostel ){
    	this.matricNo = matricNo; 
    	this.name = name;
    	this.phoneNo = phoneNo;
    	this.hostel = hostel;

    }
    
    //Sector //MUTATOR
    public void setMatricNo(String matricNo){
        this.matricNo = matricNo;
    } 
    
    public void setName(String name){
        this.name = name;
    } 

    public void setPhoneNo(String phoneNo){
        this.phoneNo = phoneNo;
    }
    
    public void setHostel(int hostel){
        this.hostel = hostel;
    } 
    
    //Getter //ACCESSOR
    public String getMatricNo(){
        return matricNo;
    } 
    
    public String getName(){
        return name;
    } 
    
    public String getPhoneNo(){
        return phoneNo;
    } 
    
    public int getHostel(){
        return hostel;
    }
    
    public String toString() {
    	
    	String nameHostel;
    	if(getHostel() == 1 ) 
    		nameHostel = "TDI";
    	else
    		nameHostel = "PERWIRA";
    	
        return String.format("|%s\t|%s\t\t|%s\t|%s\t|",getMatricNo(),getName(),getPhoneNo(),nameHostel);
    }

}
