using System.Diagnostics;
using System.Dynamic;
using ISchoolWebApp01.Models;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;

namespace ISchoolWebApp01.Controllers
{
    public class DataRetrieval
    {
        private readonly HttpClient _httpClient;
        private const string BaseUrl = "https://ischool.gccis.rit.edu/api/";

        public DataRetrieval()
        {
            _httpClient = new HttpClient();
        }

        public async Task<string> GetData(string url)
        {
            try
            {
                string fullUrl = BaseUrl + url;
                HttpResponseMessage response = await _httpClient.GetAsync(fullUrl);
                return await response.Content.ReadAsStringAsync();
            }
            catch (Exception ex)
            {
                throw new Exception("Error retrieving data from url. " + ex);
            }
        }
    }

    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;

        public HomeController(ILogger<HomeController> logger)
        {
            _logger = logger;
        }

        public async Task<IActionResult> Index()
        {
            DataRetrieval data = new DataRetrieval();
            var loadedAbout = await data.GetData("about/");
            var jsonAboutResults = JsonConvert.DeserializeObject<About>(loadedAbout);
            var loadedEmployment = await data.GetData("employment/");
            var jsonEmpResults = JsonConvert.DeserializeObject<Employment>(loadedEmployment);
            var loadedNews = await data.GetData("news/");
            var jsonNewsLoaded = JsonConvert.DeserializeObject<News>(loadedNews);

            dynamic expando = new ExpandoObject();
            var comboModel = expando as IDictionary<string, object>;
            comboModel.Add("About", jsonAboutResults);
            comboModel.Add("Employment", jsonEmpResults);
            comboModel.Add("News", jsonNewsLoaded);

            return View(comboModel);
        }

        public async Task<ActionResult> Degrees()
        {
            DataRetrieval data = new DataRetrieval();
            var loadedData = await data.GetData("degrees/");
            var jsonResult = JsonConvert.DeserializeObject<Degrees>(loadedData);
            return View(jsonResult);
        }

        public async Task<ActionResult> Employment()
        {
            DataRetrieval data = new DataRetrieval();
            var loadedData = await data.GetData("employment/");
            var jsonResult = JsonConvert.DeserializeObject<Employment>(loadedData);
            return View(jsonResult);
        }

        public async Task<IActionResult> People()
        {
            DataRetrieval dataR = new DataRetrieval();
            var loadedPep = await dataR.GetData("people/");
            var jsonResult = JsonConvert.DeserializeObject<PeopleModel>(loadedPep);
            return View(jsonResult);
        }

        public async Task<ActionResult> MinorCourses()
        {
            DataRetrieval data = new DataRetrieval();

            var loadedMinors = await data.GetData("minors/");
            var jsonMinorsResults = JsonConvert.DeserializeObject<Minors>(loadedMinors);

            var loadedCourses = await data.GetData("course/");
            var jsonCourseResults = JsonConvert.DeserializeObject<List<Courses>>(loadedCourses);

            dynamic expando = new ExpandoObject();
            var comboModel = expando as IDictionary<string, object>;
            comboModel.Add("Minors", jsonMinorsResults);
            comboModel.Add("Courses", jsonCourseResults);

            return View(comboModel);
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
