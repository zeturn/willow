import pymysql
import random
import jieba
import jieba.posseg as pseg
import google.generativeai as genai
import re
import time

def connect_db():
    return pymysql.connect(
        host="154.12.37.165",  # 替换为您的数据库主机地址
        user="root",  # 替换为您的数据库用户名
        password="Jad57boq!",  # 替换为您的数据库密码
        database="HD6",  # 替换为您的数据库名
        port=3307
    )

def init_db(cursor):
    cursor.execute(
        """
        CREATE TABLE IF NOT EXISTS results (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            content TEXT,
            update_time DATETIME NULL  -- Here is the corrected line
        )
        """
    )

def read_data(cursor, table_name):
    cursor.execute(f"SELECT id, name, content, update_time FROM {table_name}")
    return cursor.fetchall()

def insert_result(cursor, data):
    query = "INSERT INTO results (id, name, content, update_time) VALUES (%s, %s, %s, %s)"
    cursor.execute(query, data)

def generate_paraphrased_content(content):
    # 重试配置
    max_retries = 3  # 最大重试次数
    retries = 0      # 当前重试次数

    while retries < max_retries:
        try:
            # 配置API密钥
            genai.configure(api_key="AIzaSyB3mT7uWnmJ2S-GMwi9HDuU8d5Qai0FdwI")

            # 设置模型配置
            generation_config = {
                "temperature": 0.9,
                "top_p": 1,
                "top_k": 1,
                "max_output_tokens": 2048,
            }

            # 安全设置
            safety_settings = [
                {"category": "HARM_CATEGORY_HARASSMENT", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_HATE_SPEECH", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold": "BLOCK_NONE"},
            ]

            # 初始化模型
            model = genai.GenerativeModel(model_name="gemini-pro",
                                          generation_config=generation_config,
                                          safety_settings=safety_settings)

            # 准备输入数据
            prompt_parts = [
                "You are an article cleaning GPT, and I will send you an entry from an encyclopedia website that explains professional terminology. Your task is to paraphrase the meaning of the entry based on its content. According to the purpose of use, your answer will be directly entered into our database, which means you need to provide a paraphrase directly without any other content (such as: okay, I will help you paraphrase the article, I understand your article, etc.), you need to provide the article directly. You need to paraphrase in a rigorous and objective tone so that everyone can understand the meaning of the entry. The entry needs to provide the usage of this word as much as possible. You need to make the entries more coherent. You need to make the entry detailed and informative. At the same time, you need to ensure that the generated result is different from all the sentences, word order, and word usage in the original entry. You need to provide a Chinese answer. Here are the entries (which may be in Chinese):",
                content
            ]

            # 尝试生成内容
            response = model.generate_content(prompt_parts)

            # 检查response是否有效
            if response and response.text:
                return response.text  # 成功获取响应

        except Exception as e:
            # 捕获异常，准备重试
            retries += 1  # 重试次数加1

    # 所有重试均失败
    return "等待解释"

# 负责生成胡言乱语
import jieba
import jieba.posseg as pseg
import random

def replace_words_with_same_pos(content, title, word_dict, replace_prob=0.5):
    # 分词并获取title的词性
    title_words = {word for word, _ in pseg.lcut(title)}

    # 新的content
    new_content = []

    # 分词并替换content中的词
    for word, pos in pseg.lcut(content):
        if word not in title_words and pos in word_dict and random.random() < replace_prob:
            # 有60%的概率替换相同词性的词
            new_word = random.choice(word_dict[pos])
            new_content.append(new_word)
        else:
            new_content.append(word)

    return ''.join(new_content)

# 示例词汇库（简化版本）
word_dict = {
    'n': ['华为手机', '原神', 'ikun','丁真','怪零','细颈瓶','原石','YUAN','迷你世界','孙笑川','老八','奥里给','小学生','米哈游','元梦之星','马化腾'],  # 名词
    'v': ['唱', '跳', '撸', '搓', '拔', '淦', '捻'],   # 动词
    # ... 其他词性
}

def replace_title_words_in_content_xi(title, content):
    # 分词
    title_words = jieba.lcut(title)

    # 替换词列表
    replacement_words = ["四个意识", "四个自信", "两个维护", "两个确立", "八个明确", "十个明确", "七个有之", "五个必须", "五个决不允许", "六个坚持", "五个必由之路", "三个务必"]

    # 替换词语列表
    replacements = [
              "坚决反对形式主义、官僚主义，坚决反对享乐主义、奢靡之风，坚决同一切消极腐败现象作斗争。",
              "2019年，我们用汗水浇灌收获，以实干笃定前行",
              "历史长河奔腾不息，有风平浪静，也有波涛汹涌。我们不惧风雨，也不畏险阻，中国将坚定不移走和平发展道路，坚定不移维护世界和平，促进共同发展。",
              "中国人民从来没有欺负、压迫、奴役过其他国家人民，过去没有，现在没有，将来也不会有。",
              "创新始终是推动一个国家、一个民族向前发展的重要力量。",
              "万物得其本者生，百事得其道者成。",
              "当代中国青年是与新时代同向同行，共同前进的一代，生逢盛世，肩负重任。",
              "追梦需要激情和理想，圆梦需要奋斗和贡献。",
              "平凡铸就伟大， 英雄来自人民。 每个人都了不起。",
              "你们说，今天的幸福生活来之不易，这话讲的很好，希望你们怀着一颗感恩的心，珍惜时光，努力学习。将来做对国家，对人民，对社会有用的人。",
              "既要下决心消除绝对贫困 ，又不能把胃口吊得太高 ，使大家期望值太高 力不从心 小马拉大车，也拉不动，你拉不动的结果是，好心没办成好事",
              "妄想欺负中国者，必将碰得头破血流。",
              "观乎天文，以察时变；观乎人文，以化成天下。",
              "现在的一些领导干部，很会做“领导工作”但不会做群众工作。",
              "中国精神是凝心聚力的兴国之魂、强国之魂实现中国梦必须弘扬中国精神。这就是以爱国主义为核心的民族精神，以改革创新为核心的时代精神。这种精神是凝心聚力的兴国之魂、强国之魂。爱国主义始终是把中华民族坚强团",
              "观今宜鉴古，无古不成今。”“观今宜鉴古，无古不成今。”总结历史是为了使全党从历史进程中洞察历史发展规律和时代发展大势，提高认识水平和辨别能力，增强锚定既定奋斗目标、意气风发走向未来的勇气和力量，更加",
              "青年兴则国家兴，青年强则国家强。",
              "中国共产党根基在人民、血脉在人民。党团结带领人民进行革命、建设、改革，根本目的就是为了让人民过上好日子，无论面临多大挑战和压力，无论付出多大牺牲和代价，这一点都始终不渝、毫不动摇。",
              "坚持就是胜利，团结就是胜利。",
              "只要高举爱国主义的伟大旗帜，中国人民和中华民族就能在改造中国、改造世界的拼搏中迸发出排山倒海的历史伟力！",
              "不忘初心，方得始终。我们唯有踔厉奋发、笃行不怠，方能不负历史、不负时代、不负人民大国之大，也有大国之重。千头万绪的事，说到底是千家万户的事民之所忧，我必念之；民之所盼，我必行之全面小康、摆脱贫困",
              "中华民族迎来了从站起来、富起来到强起来的伟大飞跃。",
              "中国特色社会主义进入了新时代。",
              "新征程上，只要我们始终站稳人民立场，坚持人民至上，把人民对美好生活的向往作为始终不渝的奋斗目标，就一定能够激发出无往而不胜的强大力量，不断书写中华民族伟大复兴的精彩华章！",
              "毛泽东说：“没有林也不成其为世界。”",
              "心系祖国，造福桑梓，以实际行动建功新时代。",
              "新时代的伟大成就是党和人民一道拼出来、干出来、奋斗出来的！”",
              "一个国家的进步，镌刻着青年的足迹；一个民族的未来，寄望于青春的力量。",
              "历史不会因时代变迁而改变，事实也不会因巧舌抵赖而消失。",
              "希望全国广大青年牢记党的教诲，立志民族复兴，不负韶华，不负时代，不负人民，在青春的赛道上奋力奔跑，争取跑出当代青年的最好成绩！立足新时代新征程，中国青年的奋斗目标和前行方向归结到一点，就是坚定不移听",
              "坚定信念：心中有信仰，脚下有力量共产主义是我们党的远大理想，为了实现这个远大理想，就必须坚定中国特色社会主义信念。全党同志要增强“四个意识”、坚定“四个自信”，在全面建设社会主义现代化国家新征程上披",
              "习近平论把我国制度优势更好转化为国家治理效能深入推进改革创新，坚定不移扩大开放，着力破解深层次体制机制障碍，不断彰显中国特色社会主义制度优势，不断增强社会主义现代化建设的动力和活力，把我国制度优势更",
              "尚贤者，政之本也。",
              "没有任何力量能够撼动我们伟大祖国的地位 没有任何力量能够阻挡中国人民和中华民族的前进步伐",
              "团结奋斗，锐意进取，努力拼搏，复兴中华，祝愿人民越来越富有，祝愿伟大的祖国越来越繁荣昌盛！！！",
              "全球化时代，不应该是一部分人反对另一部分人，而应该是所有人造福所有人。"]

    # 替换title中的词语
    for word in title_words:
        content = content.replace(word, random.choice(replacement_words))

    # 找到所有符号的位置
    symbols = ['。', '，', '！', '？', '；', '：']
    symbol_positions = [m.start() for symbol in symbols for m in re.finditer(re.escape(symbol), content)]

    # 随机选择一个符号位置进行替换
    if symbol_positions:
        random_position = random.choice(symbol_positions)
        content = content[:random_position + 1] + random.choice(replacements) + content[random_position + 1:]

    return content


def main():
    print('start')
    db = connect_db()
    cursor = db.cursor()

    init_db(cursor)
    db.commit()

    original_table = "memes"  # 替换为您的原始数据表名
    data = read_data(cursor, original_table)

    for row in data:
        id, name, content, update_time = row

        # 生成新内容
        time.sleep(1)
        new_content = generate_paraphrased_content(content)

        # 插入到result表
        insert_result(cursor, (id, name, new_content, update_time))
        db.commit()

        # 生成混淆数据
        title = name
        confusing_sentences = replace_words_with_same_pos(content, title, word_dict)
        confusing_sentences_xi = replace_title_words_in_content_xi(title, content)

        # 向API发送混淆数据（这里需要您根据实际情况编写API调用代码）
        time.sleep(1)
        new_confusing_sentences = generate_paraphrased_content(confusing_sentences)
        time.sleep(1)
        new_confusing_sentences_xi = generate_paraphrased_content(confusing_sentences_xi)

        # 打印混淆结果
        #print("混淆一")
        #print(new_confusing_sentences)
        #print("混淆二")
        #print(new_confusing_sentences_xi)

    cursor.close()
    db.close()

if __name__ == "__main__":
    main()