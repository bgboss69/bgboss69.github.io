public class Laptop {

	private String cpu;
	private double ram;
    private double ssd;

	//non-argument constructor	
	public Laptop() {
        setCpu("i-7");
        setRam(4.0);
        setSsd(18);
    }

	//parameter constructor
    public Laptop(String cpu, double ram,double ssd) {
		setCpu(cpu);
        setRam(ram);
        setSsd(ssd);
	}
	//mutators
	public void setCpu(String a) {
		this.cpu = a;
	}
	
	public void setRam(double b) {
		this.ram = b;
	}

    public void setSsd(double c) {
		this.ssd = c;
	}
	
	
	//accessors
	public String getCpu() {
		return cpu;
	}
	
	public double getRam() {
		return ram;
	}
	
	public double getSsd() {
		return ssd;
	}

	public static void main(String[] args) {
		Laptop hp1 = new Laptop();
		Laptop hp2 = new Laptop("i-8",4.0,8.0);


		System.out.println("my hp1 computer with cpu:" + hp1.getCpu() +",ram: "+ hp1.getRam() +",ssd: " +hp1.getSsd());
		System.out.println("my hp2 computer with cpu:" + hp2.getCpu() +",ram: "+ hp2.getRam() +",ssd: " +hp2.getSsd());
	}
}