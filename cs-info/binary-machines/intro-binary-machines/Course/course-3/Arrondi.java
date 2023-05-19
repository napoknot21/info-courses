class Arrondi{
    public static void olala(){
        float f=0.0f;       //IEEE 754 sur 32 bits
        double d = 3.14;    //IEEE 754 sur 64 bits
        while(f!=14.0){     //écriture de condition à bannir
            f = f + 0.14f;
            System.out.println(f);
        }
    }
    public static void main(String[] args){
        System.out.println("π sur 32 bits: "+Math.PI);
        
        System.out.println(Float.intBitsToFloat(0xC2ED4000));
        
        System.out.println(0.3f-0.2f==0.2f-0.1f);
        
        olala();           //boucle!!
    }
}
