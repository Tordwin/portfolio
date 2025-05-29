namespace ISchoolWebApp01.Models
{
    public class Older
    {
        public string date { get; set; }
        public string title { get; set; }
        public string description { get; set; }
    }

    public class News
    {
        public List<Older> older { get; set; }
    }


}